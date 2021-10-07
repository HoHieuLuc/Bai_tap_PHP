<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tính chu vi và diện tích</title>
    <style>
        fieldset {
            background-color: #eeeeee;
            width: fit-content;
        }

        legend {
            background-color: gray;
            color: white;
            padding: 5px 10px;
        }

        input {
            margin: 5px;
        }
    </style>
</head>

<body>
    <?php
    require('Bai1_hinh.php');
    $ten = $_POST['ten'] ?? '';
    $doDai = $_POST['doDai'] ?? '';
    // nếu doDai bỏ trống thì sẽ đặt doDai = 0
    $doDai = $doDai !== '' ? $doDai : '0';
    $chonHinh = $_POST['hinh'] ?? 'hinhVuong';
    $chuoiKetQua = NULL;
    if (isset($_POST['tinh'])) {
        if (is_numeric($doDai[0]) && $doDai > 0) {
            if ($chonHinh == "hinhVuong") {
                $hinhVuong = new HinhVuong();
                $hinhVuong->setTen($ten);
                $hinhVuong->setDoDai($doDai);
                $chuoiKetQua = $hinhVuong;
            }
            if ($chonHinh == "hinhTron") {
                $hinhTron = new HinhTron();
                $hinhTron->setTen($ten);
                $hinhTron->setDoDai($doDai);
                $chuoiKetQua = $hinhTron;
            }
            if ($chonHinh == "hinhTamGiacDeu") {
                $hinhTamGiacDeu = new HinhTamGiacDeu($doDai);
                $hinhTamGiacDeu->setTen($ten);
                $hinhTamGiacDeu->setDoDai($doDai);
                $chuoiKetQua = $hinhTamGiacDeu;
            }
            if ($chonHinh == "hinhTamGiac") {
                $canhTamGiac = explode(',', $doDai);
                if (count($canhTamGiac) == 3) {
                    $hinhTamGiac = new HinhTamGiac($canhTamGiac);
                    $hinhTamGiac->setTen($ten);
                    $hinhTamGiac->setDoDai($doDai);
                    $chuoiKetQua = $hinhTamGiac;
                } else {
                    $chuoiKetQua = "Nhập vào 3 cạnh phân cách nhau bởi dấu phẩy (ví dụ: 1, 1, 1)";
                }
            }
            if ($chonHinh == "hinhChuNhat") {
                $canhHinhChuNhat = explode(',', $doDai);
                if (count($canhHinhChuNhat) == 2) {
                    $hinhChuNhat = new HinhChuNhat($canhHinhChuNhat);
                    $hinhChuNhat->setTen($ten);
                    $hinhChuNhat->setDoDai($doDai);
                    $chuoiKetQua = $hinhChuNhat;
                } else {
                    $chuoiKetQua = "Nhập vào 2 cạnh phân cách nhau bởi dấu phẩy (ví dụ: 1, 1)";
                }
            }
        } else {
            $chuoiKetQua = 'Độ dài phải lớn hơn 0';
        }
    }
    ?>
    <form action="" method="post" autocomplete="off">
        <fieldset>
            <legend>Tính chu vi và diện tích các hình đơn giản</legend>
            <table border='0'>
                <tr>
                    <td>Chọn hình</td>
                    <td>
                        <input type="radio" id="hinhVuong" name="hinh" value="hinhVuong" <?php if ($chonHinh == 'hinhVuong') echo 'checked' ?> />
                        <label for="hinhVuong">Hình vuông</label>

                        <input type="radio" id="hinhTron" name="hinh" value="hinhTron" <?php if ($chonHinh == 'hinhTron') echo 'checked' ?> />
                        <label for="hinhTron">Hình tròn</label>

                        <input type="radio" id="hinhTamGiacDeu" name="hinh" value="hinhTamGiacDeu" <?php if ($chonHinh == 'hinhTamGiacDeu') echo 'checked' ?> />
                        <label for="hinhTamGiacDeu">Hình tam giác đều</label>

                        <input type="radio" id="hinhTamGiac" name="hinh" value="hinhTamGiac" <?php if ($chonHinh == 'hinhTamGiac') echo 'checked' ?> />
                        <label for="hinhTamGiac">Hình tam giác thường</label>

                        <input type="radio" id="hinhChuNhat" name="hinh" value="hinhChuNhat" <?php if ($chonHinh == 'hinhChuNhat') echo 'checked' ?> />
                        <label for="hinhChuNhat">Hình chữ nhật</label>
                    </td>
                </tr>
                <tr>
                    <td>Nhập tên:</td>
                    <td><input type="text" name="ten" value="<?php echo $ten ?>" /></td>
                </tr>
                <tr>
                    <td>Nhập độ dài:</td>
                    <td><input type="text" name="doDai" value="<?php echo $doDai ?>" /></td>
                </tr>
                <tr>
                    <td>Kết quả:</td>
                    <td><textarea name="ketqua" cols="70" rows="4" disabled="disabled"><?php echo $chuoiKetQua; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="tinh" value="TÍNH" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>