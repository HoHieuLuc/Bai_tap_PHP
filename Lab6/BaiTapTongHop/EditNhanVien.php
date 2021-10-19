<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa nhân viên</title>
</head>

<body>
    <?php
    include("index.php");
    require_once("connect.php");
    require_once("myFunction.php");

    $maNV = $_GET['id1'];

    $query = "SELECT * FROM nhan_vien WHERE ma_nv = '$maNV'";
    $result = mysqli_query($conn, $query);
    $nhanVien = $result->fetch_assoc();

    $ho = $_POST['ho'] ?? $nhanVien['ho'];
    $ten = $_POST['ten'] ?? $nhanVien['ten'];
    $ngaySinh = $_POST['ngaySinh'] ?? $nhanVien['ngay_sinh'];
    $gioiTinh = $_POST['gioiTinh'] ?? $nhanVien['gioi_tinh'];
    $diaChi = $_POST['diaChi'] ?? $nhanVien['dia_chi'];
    $maLoaiNV = $_POST['maLoaiNV'] ?? $nhanVien['ma_loai_nv'];
    $maPhong = $_POST['maPhong'] ?? $nhanVien['ma_phong'];
    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ho = trim($ho);
        $ten = trim($ten);
        $diaChi = trim($diaChi);
        if (empty($ho)) {
            $errors[] = 'Chưa nhập họ';
        }
        if (empty($ten)) {
            $errors[] = 'Chưa nhập tên';
        }
        if (empty($diaChi)) {
            $errors[] = 'Chưa nhập địa chỉ';
        }
        if ($_FILES['anhNV']['name'] != '') {
            $hinh = $_FILES['anhNV'];
            $tmp = $hinh['tmp_name'];
            if (!getimagesize($tmp)) {
                $errors[] = 'File không hợp lệ';
            }
        }
        if (empty($errors)) {
            $anhNV = $_FILES['anhNV']['name'];
            // nếu ảnh không được chọn thì lấy ảnh cũ
            if ($anhNV == '') {
                $anhNV = $nhanVien['anh'];
            }
            $tmp = $_FILES['anhNV']['tmp_name'];
            move_uploaded_file($tmp, 'images/' . $anhNV);
            $query =
                "UPDATE nhan_vien
                SET ho = ?, ten = ?, ngay_sinh = ?, gioi_tinh = ?,
                    dia_chi = ?, anh = ?, ma_loai_nv = ?, ma_phong = ?
                WHERE ma_nv = '$maNV'
                ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param(
                "sssissss",
                $ho,
                $ten,
                $ngaySinh,
                $gioiTinh,
                $diaChi,
                $anhNV,
                $maLoaiNV,
                $maPhong
            );
            $stmt->execute();

            if ($conn->affected_rows == 1) {
                header("Location: " . "DanhSachNhanVien.php");
            } else {
                echo "Sửa không thành công";
            }
        }
    }

    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border" enctype="multipart/form-data">
            <div class="grid-container">
                Mã nhân viên
                <input type="text" disabled value="<?php echo $maNV ?>">
                Họ nhân viên
                <input type="text" name="ho" value="<?php echo $ho ?>">
                Tên nhân viên
                <input type="text" name="ten" value="<?php echo $ten ?>">
                Ngày sinh
                <input type="date" name="ngaySinh" value="<?php echo $ngaySinh ?>">
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
                </div>
                Địa chỉ
                <textarea name="diaChi"><?php echo $diaChi ?></textarea>
                Ảnh
                <input type="FILE" name="anhNV" />
                Loại nhân viên
                <select name="maLoaiNV">
                    <?php
                    $query = "SELECT * FROM loai_nhanvien";
                    $result = mysqli_query($conn, $query);
                    buildDropDownList($result, 'maLoaiNV', 'ma_loai_nv', 'ten_loai_nv', $maLoaiNV);
                    ?>
                </select>
                Phòng ban
                <select name="maPhong">
                    <?php
                    $query = "SELECT * FROM phong_ban";
                    $result = mysqli_query($conn, $query);
                    buildDropDownList($result, 'maPhong', 'ma_phong', 'ten_phong', $maPhong);
                    ?>
                </select>

            </div>
            <div class="center">
                <input type="submit" name="edit" value="Sửa" class="simple-button">
            </div>
        </form>
    </div>

    <?php
    if (!empty($errors)) {
        $thongBao = "Lỗi:" . "<br>";
        foreach ($errors as $err) {
            $thongBao .= "- " . $err . "<br>";
        }
        echo $thongBao;
    }
    ?>
</body>

</html>