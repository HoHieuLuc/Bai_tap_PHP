<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Lab3/BaiTapTongHop/myStyle.css">
    <title>Bài 1</title>
</head>

<body>
    <?php
    $soNguyen = $_POST['soNguyen'] ?? 10;
    $ketQua = '';

    function kiemTraSoNguyenTo($val)
    {
        if ($val <= 1) {
            return false;
        }
        for ($i = 2; $i <= sqrt($val); $i++) {
            if ($val % $i == 0) {
                return false;
            }
        }
        return true;
    }

    function inCacSoNguyenToNhoHonN($n)
    {
        $chuoiCacSo = '';
        for ($i = 2; $i <= $n; $i++) {
            if (kiemTraSoNguyenTo($i)) {
                $chuoiCacSo .= $i . '; ';
            }
        }
        return $chuoiCacSo;
    }


    function chuSoLonNhatTrongSoNguyenN($n)
    {
        $max = 0;
        while ($n >= 1) {
            if ($n % 10 > $max) {
                $max = $n % 10;
            }
            $n /= 10;
        }
        return $max;
    }

    if ($soNguyen < 10 || $soNguyen > 1000) {
        $ketQua = 'Số nguyên nhập vào phải từ 10 đến 1000';
    } else {
        $ketQua = 'Các số nguyên tố nhỏ hơn hoặc bằng ' . $soNguyen . ':&#13;&#10;' . inCacSoNguyenToNhoHonN($soNguyen) .
            '&#13;&#10;Số ' . $soNguyen . ' có ' . strlen($soNguyen) . ' số chữ số' .
            '&#13;&#10;Chữ số lớn nhất: ' . chuSoLonNhatTrongSoNguyenN($soNguyen);
    }

    ?>
    <form action="" method="post" class="my-form">
        <div class="grid-container">
            Nhập 1 số nguyên:
            <input type="number" name="soNguyen" value="<?php echo $soNguyen ?>">
            Kết quả:
            <textarea rows="20" cols="50"><?php echo $ketQua ?></textarea>
        </div>
        <div class="center">
            <input type="submit" value="Submit">
        </div>
    </form>
</body>

</html>