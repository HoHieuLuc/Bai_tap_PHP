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

    $maPhong = $_GET['id1'];

    $query = "SELECT * FROM phong_ban WHERE ma_phong = '$maPhong'";
    $result = mysqli_query($conn, $query);
    $phong = $result->fetch_assoc();

    $tenPhong = $_POST['tenPhong'] ?? $phong['ten_phong'];

    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tenPhong = trim($tenPhong);
        if (empty($tenPhong)) {
            $errors[] = 'Chưa nhập tên phòng';
        }

        if (empty($errors)) {
            $query =
                "UPDATE phong_ban
                SET ten_phong = ?
                WHERE ma_phong = '$maPhong'
                ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param(
                "s",
                $tenPhong,
            );
            $stmt->execute();

            if ($conn->affected_rows == 1) {
                header("Location: " . "DanhSachPhong.php");
            } else {
                echo "Sửa không thành công";
            }
        }
    }

    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border" enctype="multipart/form-data">
            <div class="grid-container">
                Mã phòng
                <input type="text" disabled value="<?php echo $maPhong ?>">
                Tên phòng
                <input type="text" name="tenPhong" value="<?php echo $tenPhong ?>">
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