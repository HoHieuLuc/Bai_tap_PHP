<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/myStyle.css">
    <title>Bài 1. Tính diện tích hình chữ nhật</title>
</head>

<body>
    <!-- tính diện tích hình chữ nhật -->
    <?php
    $chieuDai = isset($_POST['chieuDai']) && is_numeric($_POST['chieuDai']) ? $_POST['chieuDai'] : 0;
    $chieuRong = isset($_POST['chieuRong']) && is_numeric($_POST['chieuRong']) ? $_POST['chieuRong'] : 0;
    $dienTich = $chieuDai * $chieuRong;
    ?>

    <form action="" method="post" class="my-form">
        <div class="center">
            Diện tích hình chữ nhật
        </div>
        <div class="grid-container">
            Chiều dài: <input type="number" min=0 step="any" name="chieuDai" value="<?php echo $chieuDai ?>">
            Chiều rộng: <input type="number" min=0 step="any" name="chieuRong" value="<?php echo $chieuRong; ?>">
            Diện tích: <input type="text" name="dienTich" value="<?php echo $dienTich; ?>" disabled>
        </div>
        <div class="center">
            <input type="submit" value="Tính">
        </div>
    </form>
</body>

</html>