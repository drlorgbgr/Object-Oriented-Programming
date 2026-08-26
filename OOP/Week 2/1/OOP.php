<?php

//Perhitungan luas persegi panjang dengan OOP

class PersegiPanjang {
    private $panjang;
    private $lebar;

    public function keterangan($panjang, $lebar) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }
    public function hitungluas() {
        return $this->panjang * $this->lebar;
    }
}

$panjang = 10;
$lebar= 5;

$hasilLuasPersegiPanjang = new PersegiPanjang();
$hasilLuasPersegiPanjang->keterangan($panjang, $lebar);

$luas = $hasilLuasPersegiPanjang->hitungluas();

echo 'Panjang: ' . $panjang . '<br>';
echo 'Lebar: ' . $lebar . '<br>';
echo 'Luas Persegi Panjang: ' . $luas . '<br>';

?>
