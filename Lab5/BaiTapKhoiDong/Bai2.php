<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>
    <?php
    class PHAN_SO
    {
        var $tuSo, $mauSo;
        function getTuSo()
        {
            return $this->tuSo;
        }
        function setTuSo($value)
        {
            $this->tuSo = $value;
        }
        function getMauSo()
        {
            return $this->mauSo;
        }
        function setMauSo($value)
        {
            $this->mauSo = $value;
        }
        function khoitao_ps($p_ts, $p_ms)
        {
            $this->tuSo = $p_ts;
            $this->mauSo = $p_ms;
        }
        //tim USCLN cua 2 so
        function USCLN($a, $b)
        {    //neu phan so am thi doi dau cua tu so
            if ($a < 0){ 
                $a = (-1) * $a;
            }
            $sonho = ($a < $b) ? $a : $b;
            for ($i = $sonho; $i > 0; $i--)
                if (($a % $i) == 0 && ($b % $i) == 0) {    //return $i;
                    break;
                }
            return $i;
        }
        //toi gian phan so
        function toigian_ps()
        {
            $uscln = $this->USCLN($this->tuSo, $this->mauSo);
            $this->tuSo = $this->tuSo / $uscln;
            $this->mauSo = $this->mauSo / $uscln;
        }
        //tinh tong hai phan so
        function tong($p_tuso, $p_mauso)
        {
            $ps = new PHAN_SO();
            $ps->khoitao_ps($p_tuso, $p_mauso);
            $ps->tuSo = ($this->tuSo * $ps->mauSo) + ($ps->tuSo * $this->mauSo);
            $ps->mauSo = $this->mauSo * $ps->mauSo;
            $ps->toigian_ps();
            return $ps;
        }
        //tinh hieu 2 phan so
        function hieu($p_tuso, $p_mauso)
        {
            $ps = new PHAN_SO();
            $ps->khoitao_ps($p_tuso, $p_mauso);
            $ps->tuSo = ($this->tuSo * $ps->mauSo) - ($ps->tuSo * $this->mauSo);
            $ps->mauSo = $this->mauSo * $ps->mauSo;
            //$ps->toigian_ps();
            return $ps;
        }
    }

    ?>
    <?php
    $tuSo_1 = isset($_POST['tuso_1']) ? $_POST['tuso_1'] : '';
    $mauSo_1 = isset($_POST['mauso_1']) ? $_POST['mauso_1'] : '';
    $tuSo_2 = isset($_POST['tuso_2']) ? $_POST['tuso_2'] : '';
    $mauSo_2 = isset($_POST['mauso_2']) ? $_POST['mauso_2'] : '';
    ?>

    <form id="form1" name="form1" method="post" action="">
        <p><label><strong>
                    <font color="#6600FF"> Chọn phép tính trên phân số</font>
                </strong></label>&nbsp;</p>
        <p>Nhập phân số thứ 1: Tử số:
            <input name="tuso_1" type="text" id="tuso_1" size="10" maxlength="10" value="<?php echo $tuSo_1 ?>" />
            Mẫu số:
            <input name="mauso_1" type="text" id="mauso_1" size="10" maxlength="10" value="<?php echo $mauSo_1 ?>" />
        </p>
        <p>Nhập phân số thứ 2: Tử số:
            <input name="tuso_2" type="text" id="tuso_2" size="10" maxlength="10" value="<?php echo $tuSo_2 ?>" />
            Mẫu số:
            <input name="mauso_2" type="text" id="mauso_2" size="10" maxlength="10" value="<?php echo $mauSo_2 ?>" />
        </p>
        <fieldset>
            <legend>Chọn phép tính</legend>
            <p>
                <label>
                    <input type="radio" name="pheptinh" value="cộng" <?php if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "cộng") echo 'checked' ?> />
                    Cộng
                </label>

                <label>
                    <input type="radio" name="pheptinh" value="trừ" <?php if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "trừ") echo 'checked' ?> />
                    Trừ
                </label>
            </p>
        </fieldset>
        <p>
            <input name="Chon_pheptinh" type="submit" value="Kết quả" />
        </p>

    </form>
    <?php
    $ps_1 = new PHAN_SO();
    $ps_1->setTuSo($tuSo_1);
    $ps_1->setMauSo($mauSo_1);
    $ps_2 = new PHAN_SO();
    $ps_2->khoitao_ps($tuSo_2, $mauSo_2);
    $ketqua = "";
    if (isset($_POST['Chon_pheptinh'])) {
        $pheptinh = $_POST['pheptinh'];
        switch ($pheptinh) {
            case "cộng":
                $ps = new PHAN_SO();
                $ps = $ps_1->tong($ps_2->tuSo, $ps_2->mauSo);
                $ketqua = $ps_1->getTuSo() . "/" . $ps_1->getMauSo() . "+" . $ps_2->getTuSo() . "/" . $ps_2->getMauSo() . "=" . $ps->getTuSo() . "/" . $ps->getMauSo();
                break;
            case "trừ":
                $ps = new PHAN_SO();
                $ps = $ps_1->hieu($ps_2->tuSo, $ps_2->mauSo);
                $ketqua = $ps_1->getTuSo() . "/" . $ps_1->getMauSo() . "-" . $ps_2->getTuSo() . "/" . $ps_2->getMauSo() . "=" . $ps->getTuSo() . "/" . $ps->getMauSo();
                break;
        }
        echo "Phép " . $pheptinh . " là : " . $ketqua;
    }

    ?>
</body>

</html>