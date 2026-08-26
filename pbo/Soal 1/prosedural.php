<?php

// Perhitungan luas persegi panjang

function LuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

$panjang = 10;
$lebar = 5;
$Luas = LuasPersegiPanjang($panjang, $lebar);

echo 'Panjang: ' . $panjang . '<br>';
echo 'Lebar: ' . $lebar . '<br>';
echo 'Hasil Perhitungan Luas Persegi Panjang: ' . $Luas;
?>