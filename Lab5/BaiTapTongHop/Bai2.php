<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../../css/myStyle.css">
    <title>Bài 2</title>
</head>

<body>
    <?php
    require('Bai2_phanSo.php');
    $tuSo_1 = $_POST['tuSo_1'] ?? '';
    $mauSo_1 = $_POST['mauSo_1'] ?? '';
    $tuSo_2 = $_POST['tuSo_2'] ?? '';
    $mauSo_2 = $_POST['mauSo_2'] ?? '';
    $phepTinh = $_POST['phepTinh'] ?? 'cộng';

    $ps_1 = new PHAN_SO($tuSo_1, $mauSo_1);
    $ps_2 = new PHAN_SO($tuSo_2, $mauSo_2);

    $ketQua = '';
    $chuoiKetQua = '';
    if (isset($_POST['tinh'])) {
        if ($ps_1->laPhanSo() && $ps_2->laPhanSo()) {
            switch ($phepTinh) {
                case "cộng":
                    $ps = new PHAN_SO();
                    $ps = $ps_1->tongHaiPhanSo($ps_2->tuSo, $ps_2->mauSo);
                    $ketQua = $ps_1->getTuSo() . "/" . $ps_1->getMauSo() . " + " . $ps_2->getTuSo() . "/" . $ps_2->getMauSo() . " = " . $ps->getTuSo() . "/" . $ps->getMauSo();
                    break;
                case "trừ":
                    $ps = new PHAN_SO();
                    $ps = $ps_1->hieuHaiPhanSo($ps_2->tuSo, $ps_2->mauSo);
                    $ketQua = $ps_1->getTuSo() . "/" . $ps_1->getMauSo() . " - " . $ps_2->getTuSo() . "/" . $ps_2->getMauSo() . " = " . $ps->getTuSo() . "/" . $ps->getMauSo();
                    break;
                case "nhân":
                    $ps = new PHAN_SO();
                    $ps = $ps_1->tichHaiPhanSo($ps_2->tuSo, $ps_2->mauSo);
                    $ketQua = $ps_1->getTuSo() . "/" . $ps_1->getMauSo() . " * " . $ps_2->getTuSo() . "/" . $ps_2->getMauSo() . " = " . $ps->getTuSo() . "/" . $ps->getMauSo();
                    break;
                case "chia":
                    $ps = new PHAN_SO();
                    // chia phân số là nhân nghịch đảo phân số
                    $ps = $ps_1->tichHaiPhanSo($ps_2->mauSo, $ps_2->tuSo);
                    $ketQua = $ps_1->getTuSo() . "/" . $ps_1->getMauSo() . " : " . $ps_2->getTuSo() . "/" . $ps_2->getMauSo() . " = " . $ps->getTuSo() . "/" . $ps->getMauSo();
                    break;
            }
            $chuoiKetQua = "Phép " . $phepTinh . " là : " . $ketQua;
        } else {
            $chuoiKetQua = 'Phân số không hợp lệ';
        }
    }
    ?>

    <form method="post" action="" class="my-form">
        <p style="color: blue; font-weight: bold;">Chọn phép tính trên phân số</p>
        <p>Nhập phân số thứ 1: Tử số:
            <input name="tuSo_1" type="text" maxlength="10" value="<?php echo $tuSo_1 ?>" />
            Mẫu số:
            <input name="mauSo_1" type="text" maxlength="10" value="<?php echo $mauSo_1 ?>" />
        </p>
        <p>Nhập phân số thứ 2: Tử số:
            <input name="tuSo_2" type="text" maxlength="10" value="<?php echo $tuSo_2 ?>" />
            Mẫu số:
            <input name="mauSo_2" type="text" maxlength="10" value="<?php echo $mauSo_2 ?>" />
        </p>
        <fieldset>
            <legend>Chọn phép tính</legend>
            <label>
                <input type="radio" name="phepTinh" value="cộng" <?php if ($phepTinh == "cộng") echo 'checked' ?> />Cộng
            </label>
            <label>
                <input type="radio" name="phepTinh" value="trừ" <?php if ($phepTinh == "trừ") echo 'checked' ?> />Trừ
            </label>
            <label>
                <input type="radio" name="phepTinh" value="nhân" <?php if ($phepTinh == "nhân") echo 'checked' ?> />Nhân
            </label>
            <label>
                <input type="radio" name="phepTinh" value="chia" <?php if ($phepTinh == "chia") echo 'checked' ?> />Chia
            </label>
        </fieldset>
        <br>
        <div class="center">
            <input name="tinh" type="submit" value="Kết quả" />
        </div>
    </form>

    <?php
    echo $chuoiKetQua;
    ?>
</body>

</html>