<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../css/myStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2</title>
</head>

<body>
    <?php
    $daySo = $_POST['daySo'] ?? '';
    $tongDaySo = $_POST['tongDaySo'] ?? '';

    if (isset($_POST['submit'])){
        $mang = explode(',', $daySo);
        $tongDaySo = array_sum($mang);
    }
    ?>

    <form action="" method="post" class="my-form">
        <div class="center">NHẬP VÀ TÍNH TRÊN DÃY SỐ</div>
        <div class="grid-container">
            Nhập dãy số:
            <div>
                <input type="text" name="daySo" value="<?php echo $daySo ?>">
                <span style="color: red;">(*)</span>
            </div>
            <div></div>
            <input type="submit" name="submit" value="Tổng dãy số" class="half-size">
            Tổng dãy số:
            <input type="text" name="tongDaySo" disabled value="<?php echo $tongDaySo ?>">
        </div>
        <div class="center">
            <span style="color: red;">(*)</span>Các số được nhập cách nhau bằng dấu ","
        </div>
    </form>
</body>

</html>