<?php

// ========================================
// INTERFACE
// ========================================

interface Bentuk{
    public function hitungLuas();
}

// ========================================
// CLASS PERSEGI
// ========================================

class Persegi implements Bentuk{
    private $sisi;

    public function __construct($sisi){
        $this->sisi = $sisi;
    }

    public function hitungLuas(){
        return $this->sisi * $this->sisi;
    }

    public function getSisi(){
        return $this->sisi;
    }
}


// ========================================
// CLASS LINGKARAN
// ========================================

class Lingkaran implements Bentuk{
    private $radius;

    public function __construct($radius){
        $this->radius = $radius;
    }

    public function hitungLuas(){
        return 3.14 * $this->radius * $this->radius;
    }

    public function getRadius(){
        return $this->radius;
    }
}

// ========================================
// MEMBUAT OBJECT
// ========================================

$persegi = new Persegi(5);
$lingkaran = new Lingkaran(7);

// ========================================
// ARRAY OBJECT
// ========================================

$bentukList = [
    $persegi,
    $lingkaran
];

// ========================================
// MENAMPILKAN HASIL
// ========================================

echo "<h2>Hasil Perhitungan Luas</h2>";

foreach ($bentukList as $bentuk) {

    if ($bentuk instanceof Persegi) {
        echo "Luas Persegi (sisi=" . $bentuk->getSisi() . "): ";
    } elseif ($bentuk instanceof Lingkaran) {
        echo "Luas Lingkaran (radius=" . $bentuk->getRadius() . "): ";
    }

    echo $bentuk->hitungLuas();
    echo "<br>";
}

?>