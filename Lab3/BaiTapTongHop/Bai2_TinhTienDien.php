<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myStyle.css">
    <title>Bài 2. Tính tiền điện</title>
</head>

<body>
    <?php
    $tongTien = 0;
    $tenChuHo = isset($_POST['tenChuHo']) ? $_POST['tenChuHo'] : '';
    $chiSoCu = isset($_POST['chiSoCu']) && is_numeric($_POST['chiSoCu']) ? $_POST['chiSoCu'] : 0;
    $chiSoMoi = isset($_POST['chiSoMoi']) && is_numeric($_POST['chiSoMoi']) ? $_POST['chiSoMoi'] : 0;
    $donGia = isset($_POST['donGia']) && is_numeric($_POST['donGia']) ? $_POST['donGia'] : 20000;

    if ($chiSoMoi > $chiSoCu) {
        $tongTien = ($chiSoMoi - $chiSoCu) * $donGia;
    } else {
        echo "<font color='red'>Chỉ số mới phải lớn hơn chỉ số cũ! </font>";
    }
    ?>

    <form action="" method="post" class="my-form">
        <div class="center">
            Thanh toán tiền điện
        </div>
        <div class="grid-container">
            Tên chủ hộ:
            <div>
                <input type="text" name="tenChuHo" value="<?php echo $tenChuHo ?>">
            </div>
            Chỉ số cũ:
            <div>
                <input type="number" min=0 step="any" name="chiSoCu" value="<?php echo $chiSoCu ?>"> (Kw)
            </div>
            Chỉ số mới:
            <div>
                <input type="number" min=0 step="any" name="chiSoMoi" value="<?php echo $chiSoMoi ?>"> (Kw)
            </div>
            Đơn giá:
            <div>
                <input type="number" min=0 name="donGia" value="<?php echo $donGia ?>"> (VNĐ)
            </div>
            Số tiền thanh toán:
            <div>
                <input type="text" name="tongTien" value="<?php echo $tongTien ?>" disabled> (VNĐ)
            </div>
        </div>
        <div class="center">
            <input type="submit" value="Tính">
        </div>
    </form>
</body>

</html>