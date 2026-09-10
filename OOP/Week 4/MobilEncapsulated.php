<?php
class Mobil {
    // 1. Ubah semua properti menjadi private
    private $merek;
    private $warna;
    private $kecepatan;

    public function __construct($merek, $warna, $kecepatan) {
        $this->merek = $merek;
        $this->setWarna($warna);
        $this->setKecepatan($kecepatan);
    }

    // 2. Getter untuk setiap properti
    public function getMerek() {
        return $this->merek;
    }

    public function getWarna() {
        return $this->warna;
    }

    public function getKecepatan() {
        return $this->kecepatan;
    }

    // 3. Setter kecepatan dengan validasi
    public function setKecepatan($kecepatan) {
        if ($kecepatan < 0) {
            echo "Error: Kecepatan tidak boleh negatif!<br>";
        } elseif ($kecepatan > 200) {
            echo "Error: Kecepatan maksimal 200 km/jam!<br>";
        } else {
            $this->kecepatan = $kecepatan;
        }
    }

    // 4. Setter warna dengan validasi
    public function setWarna($warna) {
        $warnaTrim = trim($warna);
        if (empty($warnaTrim)) {
            echo "Error: Warna tidak boleh kosong!<br>";
        } elseif (strlen($warnaTrim) < 3) {
            echo "Error: Warna minimal 3 karakter!<br>";
        } else {
            $this->warna = $warnaTrim;
        }
    }
}

// Inisialisasi objek sesuai output yang diharapkan
$mobil1 = new Mobil("Toyota", "Merah", 80);
echo "Mobil " . $mobil1->getMerek() . " berwarna " . $mobil1->getWarna() . ", kecepatan " . $mobil1->getKecepatan() . " km/jam<br>";

// Ubah kecepatan ke 120 km/jam
$mobil1->setKecepatan(120);
echo "Kecepatan sekarang: " . $mobil1->getKecepatan() . " km/jam<br>";

// Coba atur kecepatan bernilai negatif untuk memicu validasi error
$mobil1->setKecepatan(-10);

?>