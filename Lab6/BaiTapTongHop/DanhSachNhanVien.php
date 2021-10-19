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
    require_once("myFunction.php");
    require_once("connect.php");
    /* $query = "SELECT * FROM nhan_vien nv JOIN phong_ban pb 
            ON nv.ma_phong = pb.ma_phong
            JOIN loai_nhanvien lnv ON nv.ma_loai_nv = lnv.ma_loai_nv";
    $stmt = $conn->prepare($query); */

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
    $tableHeaders = array(
        'Mã nhân viên', 'Họ', 'Tên', 'Ngày sinh', 'Giới tính',
        'Địa chỉ', 'Ảnh', 'Loại nhân viên', 'Phòng ban',
    );
    $tableData = array(
        'ma_nv' => null,
        'ho' => null,
        'ten' => null,
        'ngay_sinh' => null,
        'gioi_tinh' => 'bool - Nam - Nữ',
        'dia_chi' => null,
        'anh' => 'image',
        'ten_loai_nv' => null,
        'ten_phong' => null,
    );
    ?>
    <h2 class="center">Danh sách nhân viên</h2>
    <a href="ThemNhanVien.php">Thêm mới</a>
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
    buildTable($nhanViens, "EditNhanVien.php", "DeleteNhanVien.php", $tableHeaders, $tableData, "ma_nv");
    mysqli_close($conn);
    ?>
</body>

</html>