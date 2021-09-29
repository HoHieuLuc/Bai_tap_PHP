<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>tinh dien tich HCN</title>
    <style type="text/css">
        body {
            background-color: #d24dff;
        }

        table {
            background: #ffd94d;
            border: 0 solid yellow;
        }

        thead {
            background: #fff14d;
        }

        td {
            color: blue;
        }

        h3 {
            font-family: verdana;
            text-align: center;
            /* text-anchor: middle; */
            color: #ff8100;
            font-size: medium;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['banKinh']))
        $banKinh = trim($_POST['banKinh']);
    else $banKinh = 0;
    if (isset($_POST['tinh']))
        if (is_numeric($banKinh))
            $dientich = $banKinh * $banKinh * 3.14;
        else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>";
            $dientich = "";
        }
    else $dientich = 0;
    ?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>DIỆN TÍCH HÌNH TRÒN</h3>
                </th>
            </thead>
            <tr>
                <td>Bán kính:</td>
                <td><input type="text" name="banKinh" value="<?php echo $banKinh; ?> " /></td>
            </tr>
                <td>Diện tích:</td>
                <td><input type="text" name="dientich" disabled="disabled" value="<?php echo $dientich; ?> " /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>
            </tr>
        </table>
    </form>
</body>

</html>