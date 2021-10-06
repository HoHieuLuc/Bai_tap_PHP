<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../css/myStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3</title>
</head>

<body>
    <script type="text/javascript">

    </script>
    <?php
    session_start();
    $dayXoSo = array();
    $soDuocNhap = $_POST['soDuocNhap'] ?? '';

    function taoXoSo($giai, $soChuSo, $soLuong)
    {
        global $dayXoSo;
        for ($index = 0; $index < $soLuong; $index++) {
            // sinh ra kết quả số ngẫu nhiên
            $so = rand(0, pow(10, $soChuSo) - 1);
            // chèn số 0 vào trước kết quả
            $so = str_pad($so, $soChuSo, '0', STR_PAD_LEFT);
            $dayXoSo[$giai][$index] = $so;
        }
    }

    taoXoSo('Đặc biệt', 5, 1);
    taoXoSo('Giải nhất', 5, 1);
    taoXoSo('Giải nhì', 5, 2);
    taoXoSo('Giải ba', 5, 6);
    taoXoSo('Giải tư', 4, 4);
    taoXoSo('Giải năm', 4, 6);
    taoXoSo('Giải sáu', 3, 3);
    taoXoSo('Giải bảy', 2, 4);

    $_SESSION['dayXoSo'] = $dayXoSo;
    ?>

    <form action="Bai3_KetQua.php" method="post" class="my-form">
        <div class="grid-container">
            <?php
            foreach ($dayXoSo as $giai => $so) {
                echo "<div>" . $giai . "</div>";
                echo implode(' - ', $dayXoSo[$giai]);
            }
            ?>
            <div>Nhập số của bạn:</div>
            <input type="text" name="soDuocNhap" value="<?php echo $soDuocNhap ?>">
        </div>
        <div class="center">
            <input type="submit" value="Kiểm tra">
        </div>
    </form>
</body>

</html>