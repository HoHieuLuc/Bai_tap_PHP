<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phòng ban</title>
</head>

<body>
    <?php
    include("index.php");
    require_once("connect.php");
    require_once("myFunction.php");

    $query = "SELECT ma_phong FROM phong_ban ORDER BY ma_phong DESC";
    $result = mysqli_query($conn, $query);

    $maPhong = getNextID($result, 'ma_phong', 'PB', 3);
    $tenPhong = $_POST['tenPhong'] ?? '';
    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tenPhong = trim($tenPhong);
        if (empty($tenPhong)) {
            $errors[] = 'Chưa nhập tên phòng ban';
        }
        if (empty($errors)) {
            $query = "INSERT INTO phong_ban VALUE (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $maPhong, $tenPhong);
            $stmt->execute();
            if ($conn->affected_rows == 1) {
                header("Location: " . "DanhSachPhong.php");
            } else {
                echo "Thêm không thành công";
            }
        }
    }

    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border">
            <div class="grid-container">
                Mã phòng
                <input type="text" disabled value="<?php echo $maPhong ?>">
                Tên phòng
                <input type="text" name="tenPhong" value="<?php echo $tenPhong ?>">
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