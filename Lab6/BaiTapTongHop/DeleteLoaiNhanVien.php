<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa loại nhân viên</title>
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

    $maLoaiNV = $loaiNV['ma_loai_nv'];
    $tenLoaiNV = $loaiNV['ten_loai_nv'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $query = "DELETE FROM loai_nhanvien WHERE ma_loai_nv = '$maLoaiNV'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if ($conn->affected_rows == 1) {
            header("Location: " . "DanhSachLoaiNhanVien.php");
        } else {
            echo "Xóa không thành công";
        }
    }
    ?>

    <div class="center">
        <form action="" method="POST" class="my-form no-border">
            <div class="grid-container">
                Mã loại nhân viên
                <div><?php echo $maLoaiNV ?></div>
                Tên loại nhân viên
                <div><?php echo $tenLoaiNV ?></div>
            </div>
            <div class="center">
                <input type="submit" name="delete" value="Xóa" class="simple-button">
            </div>
        </form>
    </div>
</body>

</html>