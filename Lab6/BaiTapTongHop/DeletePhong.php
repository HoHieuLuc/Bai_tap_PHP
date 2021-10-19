<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa phòng</title>
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

    $maPhong = $phong['ma_phong'];
    $tenPhong = $phong['ten_phong'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $query = "DELETE FROM phong_ban WHERE ma_phong = '$maPhong'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if ($conn->affected_rows == 1) {
            header("Location: " . "DanhSachPhong.php");
        } else {
            echo "Xóa không thành công";
        }
    }
    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border">
            <div class="grid-container">
                Mã phòng ban
                <div><?php echo $maPhong ?></div>
                Tên phòng ban
                <div><?php echo $tenPhong ?></div>
            </div>
            <div class="center">
                <input type="submit" name="delete" value="Xóa" class="simple-button">
            </div>
        </form>
    </div>
</body>

</html>