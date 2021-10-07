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
        function __toString()
        {
            return "Diện tích hình tròn " . $this->getTen() . " là: " . $this->tinhDienTich()
                . "\n" . "Chu vi của hình tròn " . $this->getTen() . " là : " . $this->tinhChuVi();
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
        function __toString()
        {
            return "Diện tích hình vuông " . $this->getTen() . " là: " . $this->tinhDienTich()
                . "\n" . "Chu vi của hình vuông " . $this->getTen() . " là : " . $this->tinhChuVi();
        }
    }
    class HinhTamGiacDeu extends Hinh
    {
        function tinhChuVi()
        {
            return $this->doDai * 3;
        }
        function tinhDienTich()
        {
            return pow($this->doDai, 2) * sqrt(3) / 4;
        }
        function __toString()
        {
            return "Diện tích của hình tam giác đều " . $this->getTen() . " là: "
                . $this->tinhDienTich() . "\n" . "Chu vi của hình tam giác đều " . $this->getTen() . " là : "
                . $this->tinhChuVi();
        }
    }
    class HinhTamGiac extends Hinh
    {
        protected $canh_a;
        protected $canh_b;
        protected $canh_c;
        function __construct($canhTamGiac)
        {
            $this->canh_a = is_numeric($canhTamGiac[0]) ? $canhTamGiac[0] : 0;
            $this->canh_b = is_numeric($canhTamGiac[1]) ? $canhTamGiac[1] : 0;
            $this->canh_c = is_numeric($canhTamGiac[2]) ? $canhTamGiac[2] : 0;
        }
        function laHinhTamGiac()
        {
            return $this->canh_a + $this->canh_b > $this->canh_c
                && $this->canh_b + $this->canh_c > $this->canh_a
                && $this->canh_a + $this->canh_c > $this->canh_b;
        }
        function tinhChuVi()
        {
            return $this->canh_a + $this->canh_b + $this->canh_c;
        }
        function tinhDienTich()
        {
            $p = $this->tinhChuVi();
            return sqrt($p * ($p - $this->canh_a) * ($p - $this->canh_b) * ($p - $this->canh_c));
        }
        function __toString()
        {
            if ($this->laHinhTamGiac()) {
                return "Diện tích của hình tam giác " . $this->getTen() . " là: "
                    . $this->tinhDienTich() . "\n" . "Chu vi của hình tam giác "
                    . $this->getTen() . " là : "
                    . $this->tinhChuVi();
            } else {
                return "Không phải tam giác";
            }
        }
    }
    class HinhChuNhat extends Hinh
    {
        protected $chieuDai;
        protected $chieuRong;

        function __construct($canhChuNhat)
        {
            $this->chieuDai = is_numeric($canhChuNhat[0]) ? $canhChuNhat[0] : 0;
            $this->chieuRong = is_numeric($canhChuNhat[1]) ? $canhChuNhat[1] : 0;
        }
        function tinhChuVi()
        {
            return ($this->chieuDai + $this->chieuRong) * 2;
        }
        function tinhDienTich()
        {
            return $this->chieuDai * $this->chieuRong;
        }
        function __toString()
        {
            if ($this->chieuDai > 0 && $this->chieuRong > 0) {
                return "Diện tích của hình chữ nhật " . $this->getTen() . " là: "
                    . $this->tinhDienTich() . "\n" . "Chu vi của hình chữ nhật "
                    . $this->getTen() . " là : "
                    . $this->tinhChuVi();
            } else {
                return "Chiều dài và chiều rộng phải lớn hơn 0";
            }
        }
    }

    /////////////////////////
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