<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $hoTen = $_POST['hoTen'] ?? '';
    $diaChi = $_POST['diaChi'] ?? '';
    $soDienThoai = $_POST['soDienThoai'] ?? '';
    $gioiTinh = $_POST['gioiTinh'] ?? '';
    $quocTich = $_POST['quocTich'] ?? '';
    $monHoc = isset($_POST['monHoc']) ? implode(', ', $_POST['monHoc']) : 'Không có';
    $ghiChu = $_POST['ghiChu'] ?? '';
    ?>
    <h3>Bạn đã đăng nhập thành công, dưới đây là thông tin bạn nhập:</h3>
    <?php
    echo 'Họ tên: ' . $hoTen . '<br>';
    echo 'Địa chỉ: ' . $diaChi . '<br>';
    echo 'Số điện thoại: ' . $soDienThoai . '<br>';
    echo 'Giới tính: ' . $gioiTinh . '<br>';
    echo 'Quốc tịch: ' . $quocTich . '<br>';
    echo 'Môn học: ' . $monHoc . '<br>';
    echo 'Ghi chú: ' . $ghiChu . '<br>';
    ?>
    <a href="javascript:window.history.back(-1);" class="center">Trở về trang trước</a>

</body>

</html>