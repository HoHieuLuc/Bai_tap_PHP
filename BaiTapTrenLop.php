<?php
$a = rand(1, 4);
$b = rand(1, 10);
echo 'a = ' . $a . '<br>';
switch ($a) {
    case 1:
        echo 'Chu vi hình vuông có cạnh ' . $b . ' là: ' . $b * 4;
        echo '<br>';
        echo 'Diện tích hình vuông có cạnh ' . $b . ' là: ' . $b * $b;
        break;
    case 2:
        echo 'Chu vi hình tròn có bán kính ' . $b . ' là: ' . 2 * $b * 3.14;
        echo '<br>';
        echo 'Diện tích hình tròn có bán kính ' . $b . ' là: ' . $b * $b * 3.14;
        break;
    case 3:
        echo 'Chu vi tam giác đều có cạnh ' . $b . ' là: ' . $b * 3;
        echo '<br>';
        echo 'Diện tích tam giác đều có cạnh ' . $b . ' là: ' . $b * $b * sqrt(3)/4;
        break;
    case 4:
        echo 'Chu vi hình chữ nhật có cạnh a = ' . $a . ', b = ' . $b . ' là: ' . $a * 2 + $b * 2;
        echo '<br>';
        echo 'Diện tích hình chữ nhật có cạnh  a = ' . $a . ', b = ' . $b . ' là: ' . $a * $b;
        break;
    default:
        break;
}
?>