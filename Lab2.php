<a href="#bai1">Bài 1</a> |
<a href="#bai2">Bài 2</a> |
<a href="#bai3">Bài 3</a> |
<a href="#bai4">Bài 4</a> |
<a href="#bai5">Bài 5</a><hr>

<div>
    <h1 id="bai1">Bài 1</h1>
    <?php
        $soNguyenNgauNhien = rand(10, 1000);
        echo 'Số nguyên ngẫu nhiên: ' . $soNguyenNgauNhien . '<br>';
        
        function kiemTraSoNguyenTo($val){
            if($val <= 1){
                return false;
            }
            for($i = 2; $i <= sqrt($val); $i++){
                if ($val % $i == 0){
                    return false;
                }
            }
            return true;
        }
    
        function inCacSoNguyenToNhoHonN($n){
            for($i = 2; $i <= $n; $i++){
                if (kiemTraSoNguyenTo($i)){
                    echo $i . '; ';
                }
            }
        }

        function chuSoLonNhatTrongSoNguyenN($n){
            $max = 0;
            while ($n >= 1){
                if ($n % 10 > $max){
                    $max = $n % 10;
                } 
                $n /= 10;
            }
            return $max;
        }

        echo 'Các số nguyên tố nhỏ hơn n: <br>';
        inCacSoNguyenToNhoHonN($soNguyenNgauNhien);

        $soChuSo = strlen((string)$soNguyenNgauNhien);
        echo '<br>Số ' . $soNguyenNgauNhien . ' có ' . $soChuSo . ' số chữ số';

        echo '<br>Chữ số lớn nhất: ' . chuSoLonNhatTrongSoNguyenN($soNguyenNgauNhien);
    ?>
</div>

<div>
    <h1 id="bai2">Bài 2</h1>
    <?php
        $soNguyenNgauNhien = rand(1, 10);
        echo 'Bảng cửu chương ' . $soNguyenNgauNhien . '<br>';

        function bangCuuChuong($n){
            $chuoi = '';
            for($i = 1; $i <= 10; $i++){
                $chuoi .= $n . 'x' . $i . '=' . $n * $i . '<br>';
            }
            return $chuoi;
        }
        echo bangCuuChuong($soNguyenNgauNhien);
    ?>
</div>

<div>
    <h1 id="bai3">Bài 3</h1>
    <table border="1">
        <tr>
        <?php
            for ($i = 1; $i <= 10; $i++){
                echo '<td>' . bangCuuChuong($i) . '</td>';
            }
        ?>
        </tr>
    </table>
</div>

<div>
    <h1 id="bai4">Bài 4</h1>
    <?php
        $m = rand(2, 5);
        $n = rand(2, 5);
        $maTran = array();
        echo 'Ma trận ' . $m . 'x' . $n . '<br>';

        function khoiTaoMaTran($m, $n){
            GLOBAL $maTran;
            for($hang = 0; $hang < $m; $hang++){
                for($cot = 0; $cot < $n; $cot++){
                    $maTran[$hang][$cot] = rand(-100,100);
                }
            }
        }
        
        khoiTaoMaTran($m, $n);
        function xuatMaTran($m, $n){
            GLOBAL $maTran;
            echo '<table border=1>';
            for($hang = 0; $hang < $m; $hang++){
                echo '<tr>';
                for($cot = 0; $cot < $n; $cot++){
                    echo '<td>' . $maTran[$hang][$cot] . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }
        xuatMaTran($m, $n);
    ?>
</div>

<div>
    <h1 id="bai5">Bài 5</h1>
    <?php
        $soNguyenNgauNhien = rand(-100, 100);
        echo 'Số nguyên ngẫu nhiên: ' . $soNguyenNgauNhien . '<br>';

        $path = 'soNT.txt';
        $file = fopen($path, 'a+');
        if(!$file){
            echo 'Không thể mở file';
        }
        else{
            if(kiemTraSoNguyenTo($soNguyenNgauNhien)){
                file_put_contents($path, $soNguyenNgauNhien . "\n", FILE_APPEND);
            }
            echo '<br>Các số nguyên tố trong file: ';
            while(!feof($file)){
                echo fgets($file);
            }
            fclose($file);
        }   
    ?>
</div>