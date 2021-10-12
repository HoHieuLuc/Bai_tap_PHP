<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/myStyle.css">
    <title>Nhân viên</title>

    <script type="text/javascript">
        function onChange() {
            const radios = document.nhanVien.loaiNhanVien;
            if(radios[0].checked){             
                document.getElementsByName("soNgayCong")[0].disabled = true;
                document.getElementsByName("soNamCongTac")[0].disabled = false;            
            }
            if(radios[1].checked){
                document.getElementsByName("soNgayCong")[0].disabled = false;
                document.getElementsByName("soNamCongTac")[0].disabled = true;
            }
        };
        window.onload = () => onChange();
    </script>
</head>

<body>
    <?php
    abstract class Nguoi
    {
        protected $maSo;
        protected $hoTen;
        protected $ngaySinh;
        protected $gioiTinh;

        function __construct($maSo, $hoTen, $ngaySinh, $gioiTinh)
        {
            $this->maSo = $maSo;
            $this->hoTen = $hoTen;
            $this->ngaySinh = $ngaySinh;
            $this->gioiTinh = $gioiTinh;
        }

        function tinhTuoi()
        {
            return date("Y") - date("Y", strtotime($this->ngaySinh));
        }

        function getMaSo()
        {
            return $this->maSo;
        }

        function getHoTen()
        {
            return $this->hoTen;
        }

        function getNgaySinh()
        {
            return $this->ngaySinh;
        }

        function getGioiTinh()
        {
            return $this->gioiTinh;
        }

        abstract function tinhThuong();

        function __toString()
        {
            return "Mã số: " . $this->getMaSo()
                . "<br>Họ tên: " . $this->getHoTen()
                . "<br>Giới tính: " . $this->getGioiTinh()
                . "<br>Ngày sinh: " . $this->getNgaySinh();
        }
    }

    class NhanVienVanPhong extends Nguoi
    {
        const LUONG_CO_BAN = 2000000;
        private $soNamCongTac;

        function setSoNamCongTac($soNamCongTac)
        {
            $this->soNamCongTac = $soNamCongTac;
        }

        function tinhThuong()
        {
            $tuoi = date("Y") - date("Y", strtotime(parent::getNgaySinh()));
            if ($tuoi >= 22 && $tuoi <= 25) {
                return self::LUONG_CO_BAN * $this->soNamCongTac * 1.1;
            } else if ($tuoi <= 30) {
                return self::LUONG_CO_BAN * $this->soNamCongTac * 1.2;
            } else {
                return self::LUONG_CO_BAN * $this->soNamCongTac;
            }
        }

        function __toString()
        {
            return parent::__toString()
                . "<br>Lương: " . $this->tinhThuong();
        }
    }

    class NhanVienPhucVu extends Nguoi
    {
        private $chucVu = "Nhân viên phục vụ";
        private $soNgayCong;

        function setNgayCong($soNgayCong)
        {
            $this->soNgayCong = $soNgayCong;
        }

        function tinhThuong()
        {
            if ($this->soNgayCong < 28) {
                return 40000;
            } else {
                return 50000;
            }
        }

        function __toString()
        {
            return parent::__toString()
                . "<br>Chức vụ: " . $this->chucVu
                . "<br>Số ngày công: " . $this->soNgayCong
                . "<br>Tiền thưởng: " . $this->tinhThuong();
        }
    }
    ?>

    <?php
    $maSo = $_POST['maSo'] ?? '';
    $hoTen = $_POST['hoTen'] ?? '';
    $ngaySinh = $_POST['ngaySinh'] ?? date('Y-m-d');
    $gioiTinh = $_POST['gioiTinh'] ?? "Nam";
    $loaiNhanVien = $_POST['loaiNhanVien'] ?? 'VanPhong';
    $soNamCongTac = $_POST['soNamCongTac'] ?? 0;
    $soNgayCong = $_POST['soNgayCong'] ?? 0;
    $thongTinNhanVien = '';

    if (isset($_POST['submit'])) {
        if ($maSo === '' || $hoTen === '') {
            $thongTinNhanVien = "Nhập dữ liệu thiếu";
        } else {
            if ($loaiNhanVien === 'VanPhong') {
                $nv = new NhanVienVanPhong($maSo, $hoTen, $ngaySinh, $gioiTinh);
                if ($nv->tinhTuoi() >= 18) {
                    $nv->setSoNamCongTac($soNamCongTac);
                    $thongTinNhanVien = $nv;
                } else {
                    $thongTinNhanVien = "Tuổi phải trên 18";
                }
            }
            if ($loaiNhanVien === 'PhucVu') {
                $nv = new NhanVienPhucVu($maSo, $hoTen, $ngaySinh, $gioiTinh);
                if ($nv->tinhTuoi() >= 18) {
                    $nv->setNgayCong($soNgayCong);
                    $thongTinNhanVien = $nv;
                } else {
                    $thongTinNhanVien = "Tuổi phải trên 18";
                }
            }
        }
    }
    ?>

    <form action="" method="post" class="my-form" name="nhanVien">
        <div class="center">Nhập thông tin nhân viên</div>
        <div class="grid-container">
            Mã số <input type="text" name="maSo" value="<?php echo $maSo ?>">
            Họ tên <input type="text" name="hoTen" value="<?php echo $hoTen ?>">
            Ngày sinh <input type="date" name="ngaySinh" value="<?php echo $ngaySinh ?>">
            Giới tính
            <div>
                <label>
                    <input type="radio" name="gioiTinh" value="Nam" <?php if ($gioiTinh == "Nam") echo 'checked' ?> />Nam
                </label>
                <label>
                    <input type="radio" name="gioiTinh" value="Nữ" <?php if ($gioiTinh == "Nữ") echo 'checked' ?> />Nữ
                </label>
            </div>
            Loại nhân viên
            <div>
                <label>
                    <input type="radio" name="loaiNhanVien" onchange=onChange() value="VanPhong" <?php if ($loaiNhanVien == "VanPhong") echo 'checked' ?> />Văn phòng
                </label>
                <label>
                    <input type="radio" name="loaiNhanVien" onchange=onChange() value="PhucVu" <?php if ($loaiNhanVien == "PhucVu") echo 'checked' ?> />Phục vụ
                </label>
            </div>
            Số năm công tác
            <input type="number" min=0 name="soNamCongTac" value="<?php echo $soNamCongTac ?>">
            Số ngày công
            <input type="number" min=0 name="soNgayCong" value="<?php echo $soNgayCong ?>">
        </div>

        <div class="center">
            <input type="submit" value="Submit" name="submit">
        </div>
    </form>

    <?php
    echo $thongTinNhanVien;
    ?>
</body>

</html>