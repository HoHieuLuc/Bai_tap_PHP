<?php
    class PHAN_SO
    {
        var $tuSo, $mauSo;
        function getTuSo()
        {
            return $this->tuSo;
        }
        function getMauSo()
        {
            return $this->mauSo;
        }
        function __construct($p_ts = 1, $p_ms = 1)
        {
            $this->tuSo = $p_ts;
            $this->mauSo = $p_ms;
        }
        // kiểm tra mẫu số khác 0 và tử số và mẫu số là số tự nhiên
        function laPhanSo()
        {
            return $this->mauSo != 0
                && is_numeric($this->tuSo) && is_numeric($this->mauSo);
        }
        //tìm ước chung lớn nhất của a và b
        function uocChungLonNhat($a, $b)
        {
            return ($a % $b) ? $this->uocChungLonNhat($b, $a % $b) : $b;
        }

        function toiGianPhanSo()
        {
            $uocChungLonNhat = $this->uocChungLonNhat($this->tuSo, $this->mauSo);
            $this->tuSo = $this->tuSo / $uocChungLonNhat;
            $this->mauSo = $this->mauSo / $uocChungLonNhat;
            // tử số dương và mẫu số âm thì chuyển dấu - lên tử số
            if($this->tuSo > 0 && $this->mauSo < 0){
                $this->tuSo = -$this->tuSo;
                $this->mauSo = -$this->mauSo;
            }
        }

        function tongHaiPhanSo($p_tuso, $p_mauso)
        {
            $ps = new PHAN_SO($p_tuso, $p_mauso);
            $ps->tuSo = ($this->tuSo * $ps->mauSo) + ($ps->tuSo * $this->mauSo);
            $ps->mauSo = $this->mauSo * $ps->mauSo;
            $ps->toiGianPhanSo();
            return $ps;
        }

        function hieuHaiPhanSo($p_tuso, $p_mauso)
        {
            $ps = new PHAN_SO($p_tuso, $p_mauso);
            $ps->tuSo = ($this->tuSo * $ps->mauSo) - ($ps->tuSo * $this->mauSo);
            $ps->mauSo = $this->mauSo * $ps->mauSo;
            $ps->toiGianPhanSo();
            return $ps;
        }

        function tichHaiPhanSo($p_tuso, $p_mauso)
        {
            $ps = new PHAN_SO($p_tuso, $p_mauso);
            $ps->tuSo = $this->tuSo * $ps->tuSo;
            $ps->mauSo = $this->mauSo * $ps->mauSo;
            $ps->toiGianPhanSo();
            return $ps;
        }
    }
?>