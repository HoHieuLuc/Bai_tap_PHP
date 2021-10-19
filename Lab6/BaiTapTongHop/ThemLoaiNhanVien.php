<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loại nhân viên</title>
</head>

<body>
    <?php
    include("index.php");
    require_once("connect.php");
    require_once("myFunction.php");

    $maLoaiNV = $_POST['maLoaiNV'] ?? '';
    $tenLoaiNV = $_POST['tenLoaiNV'] ?? '';
    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $maLoaiNV = trim($maLoaiNV);
        $tenLoaiNV = trim($tenLoaiNV);
        if (empty($maLoaiNV)){
            $errors[] = 'Chưa nhập mã loại nhân viên';
        }
        if (empty($tenLoaiNV)) {
            $errors[] = 'Chưa nhập tên loại nhân viên';
        }
        if (empty($errors)) {
            $query = "INSERT INTO loai_nhanvien VALUE (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $maLoaiNV, $tenLoaiNV);
            $stmt->execute();
            if ($conn->affected_rows == 1) {
                header("Location: " . "DanhSachLoaiNhanVien.php");
            } else {
                echo "Thêm không thành công";
            }
        }
    }

    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border">
            <div class="grid-container">
                Mã loại nhân viên
                <input type="text" name="maLoaiNV" value="<?php echo $maLoaiNV ?>">
                Tên loại nhân viên
                <input type="text" name="tenLoaiNV" value="<?php echo $tenLoaiNV ?>">
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