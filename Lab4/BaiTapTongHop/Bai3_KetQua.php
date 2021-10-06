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
    session_start();
    $dayXoSo = $_SESSION['dayXoSo'];
    $soDuocNhap = $_POST['soDuocNhap'] ?? '';  
    echo 'Số của bạn: ' . $soDuocNhap . '<br>';
    
    function kiemTraTrungGiai($dayXoSo, $soDuocNhap)
    {
        $ketQua = '';
        foreach ($dayXoSo as $giai => $so) {
            foreach ($dayXoSo[$giai] as $so) {
                if (str_ends_with($soDuocNhap, $so)) {
                    $ketQua .= $giai . '; ';
                }
            }
        }
        if ($ketQua != ''){
            echo 'Trúng giải: ' . $ketQua;
        }
        else{
            echo 'Không trúng';
        }
    }
    kiemTraTrungGiai($dayXoSo, $soDuocNhap);
    ?>

    <div class="my-form">
        <div class="grid-container">
            <?php
            foreach ($dayXoSo as $giai => $so) {
                echo "<div>" . $giai . "</div>";
                echo implode(' - ', $dayXoSo[$giai]);
            }
            ?>
        </div>
    </div>
</body>

</html>