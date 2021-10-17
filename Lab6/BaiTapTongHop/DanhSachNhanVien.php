<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
</head>


<body>
    <?php
    include("index.php");
    require_once("connect.php");
    $query = "SELECT * FROM nhan_vien nv JOIN phong_ban pb 
            ON nv.ma_phong = pb.ma_phong
            JOIN loai_nhanvien lnv ON nv.ma_loai_nv = lnv.ma_loai_nv";
    $stmt = $conn->prepare($query);

    $maNV = $_GET['maNV'] ?? '';
    $hoTenNV = $_GET['hoTenNV'] ?? '';
    $gioiTinh = $_GET['gioiTinh'] ?? '';
    $diaChi = $_GET['diaChi'] ?? '';
    $loaiNV = $_GET['loaiNV'] ?? '';
    $phongBan = $_GET['phongBan'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Khi ô giới tính được chọn Tất cả => $gioiTinh = ''
        // Lúc này câu query sẽ chọn cả hai giới tính do OR 1=1
        $queryGioiTinh = $gioiTinh == '' ? '( nv.gioi_tinh = ? OR 1=1 )'
            : 'nv.gioi_tinh = ?';
        $query =
            "SELECT * FROM nhan_vien nv 
            JOIN phong_ban pb ON nv.ma_phong = pb.ma_phong
            JOIN loai_nhanvien lnv ON nv.ma_loai_nv = lnv.ma_loai_nv
            WHERE ma_nv LIKE CONCAT('%', ?, '%')
            AND CONCAT(nv.`ho`, ' ', nv.`ten`) LIKE CONCAT('%', ?, '%')
            AND $queryGioiTinh
            AND nv.dia_chi LIKE CONCAT('%', ?, '%')
            AND lnv.ten_loai_nv LIKE CONCAT('%', ?, '%')
            AND pb.ten_phong LIKE CONCAT('%', ?, '%')
            ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssisss", $maNV, $hoTenNV, $gioiTinh, $diaChi, $loaiNV, $phongBan);
    }

    $stmt->execute();
    $nhanViens = $stmt->get_result();
    ?>
    <h2 class="center">Danh sách nhân viên</h2>
    <div class="center">
        <form action="" method="GET" class="my-form no-border">
            <div class="grid-container">
                <div class="grid-container">
                    Mã nhân viên
                    <input type="text" name="maNV" value="<?php echo $maNV ?>">
                    Họ tên nhân viên
                    <input type="text" name="hoTenNV" value="<?php echo $hoTenNV ?>">
                    Giới tính
                    <div>
                        <label>
                            <input type="radio" name="gioiTinh" value="1" <?php if ($gioiTinh == '1') echo 'checked' ?>>
                            Nam
                        </label>
                        <label>
                            <input type="radio" name="gioiTinh" value="0" <?php if ($gioiTinh == '0') echo 'checked' ?>>
                            Nữ
                        </label>
                        <label>
                            <input type="radio" name="gioiTinh" value="" <?php if ($gioiTinh == '') echo 'checked' ?>>
                            Tất cả
                        </label>
                    </div>
                </div>
                <div class="grid-container">
                    Địa chỉ
                    <input type="text" name="diaChi" value="<?php echo $diaChi ?>">
                    Loại nhân viên
                    <input type="text" name="loaiNV" value="<?php echo $loaiNV ?>">
                    Phòng ban
                    <input type="text" name="phongBan" value="<?php echo $phongBan ?>">
                </div>
            </div>
            <div class="center">
                <div class="grid-container-same-width">
                    <input type="submit" name="timKiem" value="Tìm kiếm" class="simple-button">
                    <input type="reset" value="Nhập lại" onclick="window.location = window.location.pathname + window.location.hash;" class="simple-button">
                </div>
            </div>
        </form>
    </div>

    <?php
    if ($nhanViens) { ?>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Mã nhân viên</th>
                        <th>Họ</th>
                        <th>Tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>Ảnh</th>
                        <th>Loại nhân viên</th>
                        <th>Phòng ban</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($nhanVien = $nhanViens->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $nhanVien["ma_nv"] ?></td>
                            <td><?php echo $nhanVien["ho"] ?></td>
                            <td><?php echo $nhanVien["ten"] ?></td>
                            <td><?php echo $nhanVien["ngay_sinh"] ?></td>
                            <td><?php echo $nhanVien["gioi_tinh"] ? 'Nam' : 'Nữ' ?></td>
                            <td><?php echo $nhanVien["dia_chi"] ?></td>
                            <td><img src=<?php echo 'images/' . $nhanVien["anh"] ?> alt="ảnh nhân viên" class="small-rounded-img"></td>
                            <td><?php echo $nhanVien["ten_loai_nv"] ?></td>
                            <td><?php echo $nhanVien["ten_phong"] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo "Không có dữ liệu";
    }
    mysqli_free_result($nhanViens);
    mysqli_close($conn);
    ?>
</body>

</html>