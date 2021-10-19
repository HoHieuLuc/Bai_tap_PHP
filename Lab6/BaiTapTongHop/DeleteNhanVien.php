<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa nhân viên</title>
</head>

<body>
    <?php
    include("index.php");
    require_once("connect.php");
    require_once("myFunction.php");

    $maNV = $_GET['id1'];

    $query =
        "SELECT * FROM nhan_vien nv 
        JOIN phong_ban pb ON nv.ma_phong = pb.ma_phong
        JOIN loai_nhanvien lnv ON nv.ma_loai_nv = lnv.ma_loai_nv
        WHERE nv.ma_nv = '$maNV'
        ";
    $result = mysqli_query($conn, $query);
    $nhanVien = $result->fetch_assoc();

    $ho = $nhanVien['ho'];
    $ten = $nhanVien['ten'];
    $ngaySinh = $nhanVien['ngay_sinh'];
    $gioiTinh = $nhanVien['gioi_tinh'];
    $diaChi = $nhanVien['dia_chi'];
    $anhNV = $nhanVien['anh'];
    $tenLoaiNV = $nhanVien['ten_loai_nv'];
    $tenPhong = $nhanVien['ten_phong'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $query = "DELETE FROM nhan_vien WHERE ma_nv = '$maNV'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if ($conn->affected_rows == 1) {
            //unlink('images/' . $anhNV);
            header("Location: " . "DanhSachNhanVien.php");
        } else {
            echo "Xóa không thành công";
        }
    }
    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border">
            <div class="grid-container">
                <img src="images/<?php echo $anhNV ?>" alt="ảnh" class="small-img">
                <div class="grid-container">
                    Mã nhân viên
                    <div><?php echo $maNV ?></div>
                    Họ nhân viên
                    <div><?php echo $ho ?></div>
                    Tên nhân viên
                    <div><?php echo $ten ?></div>
                    Ngày sinh
                    <div><?php echo $ngaySinh ?></div>
                    Giới tính
                    <div><?php echo $gioiTinh ? 'Nam' : 'Nữ' ?></div>
                    Địa chỉ
                    <div><?php echo $diaChi ?></div>
                    Loại nhân viên
                    <div><?php echo $tenLoaiNV ?></div>
                    Phòng ban
                    <div><?php echo $tenPhong ?></div>
                </div>
            </div>
            <div class="center">
                <input type="submit" name="delete" value="Xóa" class="simple-button">
            </div>
        </form>
    </div>
</body>

</html>