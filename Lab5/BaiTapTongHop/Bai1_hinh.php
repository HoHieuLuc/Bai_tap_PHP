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
?>