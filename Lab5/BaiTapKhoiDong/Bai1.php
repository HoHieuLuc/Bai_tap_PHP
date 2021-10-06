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
    abstract class Hinh
    {
        protected $ten, $doDai;
        public function setTen($ten)
        {
            $this->ten = $ten;
        }
        public function getTen()
        {
            return $this->ten;
        }
        public function setDoDai($doDai)
        {
            $this->doDai = $doDai;
        }
        public function getDoDai()
        {
            return $this->doDai;
        }
        abstract public function tinhChuVi();
        abstract public function tinhDienTich();
    }
    class HinhTron extends Hinh
    {
        const PI = 3.14;
        function tinhChuVi()
        {
            return $this->doDai * 2 * self::PI;
        }
        function tinhDienTich()
        {
            return pow($this->doDai, 2) * self::PI;
        }
    }
    class HinhVuong extends Hinh
    {
        public function tinhChuVi()
        {
            return $this->doDai * 4;
        }
        public function tinhDienTich()
        {
            return pow($this->doDai, 2);
        }
    }
    $ten = $_POST['ten'] ?? '';
    $doDai = $_POST['doDai'] ?? '0';
    $chonHinh = $_POST['hinh'] ?? 'hv';
    $chuoiKetQua = NULL;
    if (isset($_POST['tinh'])) {
        if (is_numeric($doDai) && $doDai > 0) {
            if (($_POST['hinh']) == "hv") {
                $hv = new HinhVuong();
                $hv->setTen($_POST['ten']);
                $hv->setDoDai($_POST['doDai']);
                $chuoiKetQua = "Diện tích hình vuông " . $hv->getTen() . " là: " . $hv->tinhDienTich() . "\n" . "Chu vi của hình vuông " . $hv->getTen() . " là : " . $hv->tinhChuVi();
            }
            if (($_POST['hinh']) == "ht") {
                $ht = new HinhTron();
                $ht->setTen($_POST['ten']);
                $ht->setDoDai($_POST['doDai']);
                $chuoiKetQua = "Diện tích của hình tròn " . $ht->getTen() . " là: " . $ht->tinhDienTich() . "\n" . "Chu vi của hình tròn " . $ht->getTen() . " là : " . $ht->tinhChuVi();
            }
        } else {
            $chuoiKetQua = 'Độ dài phải lớn hơn 0';
        }
    }
    ?>
    <form action="" method="post">
        <fieldset>
            <legend>Tính chu vi và diện tích các hình đơn giản</legend>
            <table border='0'>
                <tr>
                    <td>Chọn hình</td>
                    <td>
                        <input type="radio" id="hv" name="hinh" value="hv" <?php if ($chonHinh == 'hv') echo 'checked' ?> />
                        <label for="hv">Hình vuông</label>
                        <input type="radio" id="ht" name="hinh" value="ht" <?php if ($chonHinh == 'ht') echo 'checked' ?> />
                        <label for="ht">Hình tròn</label>
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