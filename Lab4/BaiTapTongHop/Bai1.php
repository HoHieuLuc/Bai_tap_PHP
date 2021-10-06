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
    $soN = $_POST['soN'] ?? 0;
    $soCanChen = $_POST['soCanChen'] ?? 0;
    $viTriChen = $_POST['viTriChen'] ?? -1;
    $ketQua = '';
    $ketQuaChen = '';

    if (isset($_POST['thucHien'])) {
        if (!is_numeric($soN) || $soN <= 0) {
            $ketQua = 'Nhập vào số tự nhiên lớn hơn 0';
        } else {
            $mang = array();
            // khởi tạo mảng
            for ($index = 0; $index < $soN; $index++) {
                $mang[$index] = rand(-100, 100);
            }
            $ketQua = 'Hiển thị mảng: ' . implode(' ', $mang) . "\n";

            // xếp mảng tăng dần
            sort($mang);
            $ketQua .= 'Hiển thị mảng tăng dần: ' . implode(' ', $mang) . "\n";

            // hàm chèn 1 phần tử vào 1 mảng
            function chenMang(&$mang, $viTriChen, $soCanChen)
            {
                array_splice($mang, $viTriChen, 0, $soCanChen);
            }

            if (!is_numeric($soCanChen) || $viTriChen > count($mang) || $viTriChen < 0) {
                $ketQua .= "Số cần chèn hoặc vị trí chèn không hợp lệ\n";
            } else {
                chenMang($mang, $viTriChen, $soCanChen);
                $ketQua .= $soCanChen . ', ' . $viTriChen . "\n";
                $ketQua .= 'Mảng sau khi chèn: ' . implode(' ', $mang) . "\n";

                $ketQua .= "Sắp xếp mảng theo dạng: Từ phần tử đầu tiên đến phần tử được chèn vào là tăng dần"
                    . " từ phần tử được chèn vào đến phần tử cuối là giảm dần:\n";
                // chia mảng ban đầu thành 2 mảng, sắp xếp từng mảng con rồi ghép lại
                // chia mảng ra làm 2
                // 
                $mangTruoc = array_slice($mang, 0, $viTriChen);
                $mangSau = array_slice($mang, $viTriChen + 1, count($mang));
                // sắp xếp mảng sau theo chiều giảm dần
                rsort($mangSau);
                // thêm số được chèn vào mảng trước
                array_push($mangTruoc, $soCanChen);
                // ghép mảng trước và mảng sau
                $mang = array_merge($mangTruoc, $mangSau);
                $ketQua .= implode(' ', $mang) . "\n";
            }
        }
    }
    ?>
    <form action="" method="post">
        Nhập 1 số tự nhiên: <input type="number" name="soN" value="<?php echo $soN ?>">
        <input type="submit" name="thucHien" value="Submit"><br>
        Số cần chèn: <input type="number" name="soCanChen" value="<?php echo $soCanChen ?>">
        Vị trí cần chèn: <input type="text" name="viTriChen" value="<?php echo $viTriChen ?>"><br>
        <textarea rows="20" cols="70"><?php echo $ketQua ?></textarea><br>
    </form>
</body>

</html>