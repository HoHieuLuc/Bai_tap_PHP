<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Xử lý n</title>
</head>

<body>
    <?php
    $n = $_POST['n'] ?? 0;

    $ketQua = '';
    if (isset($_POST['hienThi'])) {    
        //Tạo mảng có n phần tử, các phần tử có giá trị ngãu nhiên từ [-200,200]
        $mang = array();
        for ($index = 0; $index < $n; $index++) {
            $mang[$index] = rand(-200, 200);
        }
        //In ra mảng vừa tạo
        $ketQua = "Mảng được tạo là:" . implode(" ", $mang) . "\n";

        //Tìm và in ra các số dương chẵn trong mảng dùng hàm foreach
        $demSoDuongChan = 0;
        $daySoDuongChan = '';
        foreach ($mang as $value) {
            if ($value % 2 == 0 && $value > 0){
                $demSoDuongChan++;
                $daySoDuongChan .= " $value";
            }
        }
        $ketQua .= "Có $demSoDuongChan số chẵn > 0 trong mảng:$daySoDuongChan" . "\n";

        //Tìm và in ra các số có chữ số cuối là số lẻ
        $ketQua .= "Các số có chữ số cuối là số lẻ là: ";
        $daySo = "";
        for ($i = 0; $i < count($mang); $i++) {
            $soCuoi = $mang[$i] % 10;
            if ($soCuoi % 2 != 0)
                $daySo .= "$mang[$i]  ";
        }
        $ketQua .= $daySo;
    }
    ?>
    <form action="" method="post">
        Nhập n: <input type="text" name="n" value="<?php echo $n ?>" />
        <input type="submit" name="hienThi" value="Hiển thị" />
    </form>
    Kết quả:<br>
    <textarea cols="70" rows="10"><?php echo $ketQua ?></textarea>
</body>

</html>