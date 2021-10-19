<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa phòng</title>
</head>

<body>
    <?php
    include("index.php");
    require_once("connect.php");
    require_once("myFunction.php");

    $maLoaiNV = $_GET['id1'];

    $query = "SELECT * FROM loai_nhanvien WHERE ma_loai_nv = '$maLoaiNV'";
    $result = mysqli_query($conn, $query);
    $loaiNV = $result->fetch_assoc();

    $tenLoaiNV = $_POST['tenLoaiNV'] ?? $loaiNV['ten_loai_nv'];

    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tenLoaiNV = trim($tenLoaiNV);
        if (empty($tenLoaiNV)) {
            $errors[] = 'Chưa nhập tên loại nhân viên';
        }

        if (empty($errors)) {
            $query =
                "UPDATE loai_nhanvien
                SET ten_loai_nv = ?
                WHERE ma_loai_nv = '$maLoaiNV'
                ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param(
                "s",
                $tenLoaiNV,
            );
            $stmt->execute();

            if ($conn->affected_rows == 1) {
                header("Location: " . "DanhSachLoaiNhanVien.php");
            } else {
                echo "Sửa không thành công";
            }
        }
    }

    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border" enctype="multipart/form-data">
            <div class="grid-container">
                Mã loại nhân viên
                <input type="text" disabled value="<?php echo $maLoaiNV ?>">
                Tên loại nhân viên
                <input type="text" name="tenLoaiNV" value="<?php echo $tenLoaiNV ?>">
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