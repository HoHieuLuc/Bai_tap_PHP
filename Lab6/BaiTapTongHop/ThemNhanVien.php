<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
</head>

<body>
    <?php
    include("index.php");
    require_once("connect.php");
    require_once("myFunction.php");

    $query = "SELECT ma_nv FROM nhan_vien ORDER BY ma_nv DESC";
    $result = mysqli_query($conn, $query);

    $maNV = getNextID($result, 'ma_nv', 'NV', 4);
    $ho = $_POST['ho'] ?? '';
    $ten = $_POST['ten'] ?? '';
    $ngaySinh = $_POST['ngaySinh'] ?? date('Y-m-d');
    $gioiTinh = $_POST['gioiTinh'] ?? '1';
    $diaChi = $_POST['diaChi'] ?? '';
    $loaiNV = $_POST['loaiNV'] ?? '';
    $phongBan = $_POST['phongBan'] ?? '';
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
            $tmp = $_FILES['anhNV']['tmp_name'];
            move_uploaded_file($tmp, 'images/' . $anhNV);
            $query = "INSERT INTO nhan_vien VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param(
                "ssssissss",
                $maNV,
                $ho,
                $ten,
                $ngaySinh,
                $gioiTinh,
                $diaChi,
                $anhNV,
                $loaiNV,
                $phongBan
            );
            $stmt->execute();
            if ($conn->affected_rows == 1) {
                header("Location: " . "DanhSachNhanVien.php");
            } else {
                echo "Thêm không thành công";
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
                <select name="loaiNV">
                    <?php
                    $query = "SELECT * FROM loai_nhanvien";
                    $result = mysqli_query($conn, $query);
                    buildDropDownList($result, 'loaiNV', 'ma_loai_nv', 'ten_loai_nv');
                    ?>
                </select>
                Phòng ban
                <select name="phongBan">
                    <?php
                    $query = "SELECT * FROM phong_ban";
                    $result = mysqli_query($conn, $query);
                    buildDropDownList($result, 'phongBan', 'ma_phong', 'ten_phong');
                    ?>
                </select>

            </div>
            <div class="center">
                <div class="grid-container-same-width">
                    <input type="submit" name="them" value="Thêm" class="simple-button">
                    <input type="button" value="Reset" onclick="window.location = window.location.pathname + window.location.hash;" class="simple-button">
                </div>
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