<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Bài 2</title>
</head>

<body>
    <?php
    $songList = array(
        "Hoa nở không màu màu" => 1,
        "Em gái mưa" => 4,
        "Bậu ơi đừng khóc" => 3,
        "Xin chào Việt Nam" => 2
    );
    ?>
    <h2>Danh sách bài hát chưa sắp xếp</h2>
    <table border="1">
        <tr>
            <th>
                <b>Bài hát</b>
            </th>
            <th><b>Hạng</b></th>
        </tr>
        <?php
        foreach ($songList as $tenBaiHat => $xepHang) {
            echo "<tr>
	 				<td>$tenBaiHat</td>
	 				<td>$xepHang</td>
	 			 </tr>";
        }
        ?>
    </table>

    <?php
    //Sắp xếp danh sách bài hát theo hạng
    asort($songList);
    ?>

    <h2>Danh sách bài hát sau khi sắp</h2>
    <table border="1">
        <tr>
            <th>
                <b>Bài hát</b>
            </th>
            <th><b>Hạng</b></th>
        </tr>
        <?php
        foreach ($songList as $tenBaiHat => $xepHang) {
            echo "<tr>
	 				<td>$tenBaiHat</td>
	 				<td>$xepHang</td>
	 			 </tr>";
        }
        ?>
    </table>
</body>

</html>