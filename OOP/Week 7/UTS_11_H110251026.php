<?php
// 1. Abstract Class ProdukMinimarket
abstract class ProdukMinimarket {
    protected $id;
    protected $nama;
    protected $hargaDasar;

    public function __construct($id, $nama, $hargaDasar) {
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaDasar = $hargaDasar;
    }

    // Getter
    public function getId() {
        return $this->id;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getHargaDasar() {
        return $this->hargaDasar;
    }

    // Abstract Methods
    abstract public function hitungTotal();
    abstract public function getJenis();
}

// 2. Child Class: Sembako
class Sembako extends ProdukMinimarket {
    private $kg;

    public function __construct($id, $nama, $hargaDasar, $kg) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->kg = $kg;
    }

    public function getJenis() {
        return "Sembako";
    }

    public function hitungTotal() {
        return $this->hargaDasar * $this->kg;
    }

    //cetakDetail()
    public function cetakDetail() {
        return "Kuantitas: {$this->kg} kg";
    }
}

// 3. Child Class: Minuman
Class Minuman extends ProdukMinimarket {
    private $botol;

    public function __construct($id, $nama, $hargaDasar, $botol) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->botol = $botol;
    }
    public function getJenis() {
        return "Minuman";
    }

    public function hitungTotal() {
        // BONUS (+5): Diskon 5% untuk minuman > Rp 100.000
        $total = $this->hargaDasar * $this->botol;
        if ($total > 100000) {
            return $total * 0.95; // Mengembalikan total setelah dikurangi diskon 5%
        } else {
            return $total;
        }

    }

    //cetakDetail()
    public function cetakDetail() {
        return "Kuantitas: {$this->botol} botol";
    }

}

// 4. Child Class: Snack
class Snack extends ProdukMinimarket {
    private $bungkus;

    public function __construct($id, $nama, $hargaDasar, $bungkus) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->bungkus = $bungkus;
    }

    public function getJenis() {
        return "Snack";
    }

    public function hitungTotal() {
        return $this->hargaDasar * $this->bungkus;
    }

    //cetakDetail()
    public function cetakDetail() {
        return "Kuantitas: {$this->bungkus} bungkus";
    }
}

// 5 objek dengan inisialisasi data pertama adalah menggunakan nama Derriel, Rasya, Raihan
$daftarProduk = [
    new Sembako(1, "Beras Derriel", 12000, 5),
    new Minuman(2, "Air Rasya", 5000, 30),
    new Snack(3, "Keripik Raihan", 15000, 10),
    new Sembako(4, "Gula", 13000, 3),
    new Minuman(5, "Jus Buah", 20000, 6)
];

$totalKeseluruhan = 0;

echo "=== DAFTAR PRODUK MINIMARKET ===<br>";

$no = 1;
foreach ($daftarProduk as $produk) {
    $totalProduk = $produk->hitungTotal();
    $totalKeseluruhan += $totalProduk;

    echo "{$no}. [{$produk->getJenis()}] {$produk->getNama()} (ID: {$produk->getId()})<br>";
    echo "   Harga Dasar : Rp " . number_format($produk->getHargaDasar()) . "<br>";
    echo "   Detail      : " . $produk->cetakDetail() . "<br>";
    echo "   Total Harga : Rp " . number_format($totalProduk) . "<br>";
    echo "-----------------------------------------<br>";
    $no++;
}

// Total Keseluruhan
echo "<br>TOTAL KESELURUHAN: Rp " . number_format($totalKeseluruhan) . "<br>";

?>