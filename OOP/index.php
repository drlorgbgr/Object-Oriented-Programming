<?php
class Mobil {
    public $merk;
    public $warna;
    public $harga;

    public function merkpertama() {
        return $this->merk; $this->warna; $this->harga; 
    }
}

$merkpertama = new Mobil();
$merkpertama->merk = "Toyota";
$merkpertama->warna = "hijau";
$merkpertama->harga = "Rp200.000.000,00";
echo "Merk Mobil: " . $merkpertama->merkpertama() . "<br>";
echo "Warna Mobil: " . $merkpertama->warna . "<br>";
echo "Harga Mobil: " . $merkpertama->harga . "<br>";

?>