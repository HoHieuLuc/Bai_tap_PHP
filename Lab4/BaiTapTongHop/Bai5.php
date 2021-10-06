<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/myStyle.css">
    <title>Document</title>
</head>

<body>
    <?php
    $danhSachMatHang = array(
        'A001' => array('Sữa tắm XMen', 'Chai 50ml', 50),
        'A002' => array('Dầu gội đầu Lifeboy', 'Chai 50ml', 20),
        'B001' => array('Dầu ăn Cái Lân', 'Chai 1 lít', 10),
        'B002' => array('Đường cát', 'Kg', 15),
        'C001' => array('Chén sứ Minh Long', 'Bộ 10 cái', 2),
    );
    $maMH = $_POST['maMH'] ?? '';
    $tenMH = $_POST['tenMH'] ?? '';
    $donViTinh = $_POST['donViTinh'] ?? '';
    $soLuong = $_POST['soLuong'] ?? '';

    if (isset($_POST['submit'])){
        $danhSachMatHang[$maMH] = array($tenMH, $donViTinh, $soLuong);
    }
    ?>

    <form action="" method="POST" class="my-form">
        <div class="grid-container">
            Mã mặt hàng
            <input type="text" name="maMH" value="<?php echo $maMH ?>">
            Tên mặt hàng
            <input type="text" name="tenMH" value="<?php echo $tenMH ?>">
            Đơn vị tính
            <input type="text" name="donViTinh" value="<?php echo $donViTinh ?>">
            Số lượng
            <input type="number" name="soLuong" value="<?php echo $soLuong ?>">
        </div>
        <div class="center">
            <input type="submit" name="submit" value="Thêm">
        </div>
    </form>
    <br>

    <table border="1" cellspacing="0">
        <tr>
            <th>Mã mặt hàng</th>
            <th>Tên mặt hàng</th>
            <th>Đơn vị</th>
            <th>Số lượng</th>
        </tr>
        <?php
        foreach ($danhSachMatHang as $maMH => $chiTietMH) {
            echo '<tr>';
            echo '<td>' . $maMH . '</td>';
            foreach ($danhSachMatHang[$maMH] as $chiTietMH) {
                echo '<td>' . $chiTietMH . '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>

</body>

</html>