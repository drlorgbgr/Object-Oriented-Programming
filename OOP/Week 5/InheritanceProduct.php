<?php

class Produk {
    protected $nama;
    protected $merek;
    protected $harga;

    public function __construct($nama, $merek, $harga) {
        $this->nama = $nama;
        $this->merek = $merek;

        // Validasi sederhana: jika bukan angka atau bernilai negatif, set ke 0
        if (is_numeric($harga) && $harga >= 0) {
            $this->harga = $harga;
        } else {
            $this->harga = 0;
            echo "Peringatan: Nilai harga tidak valid!<br>";
        }
    }

    public function getInfo() {
        return "Merek: {$this->merek}<br>" .
               "Harga: Rp " . number_format($this->harga, 0, ',', '.') . "<br>";
    }
}

class Makanan extends Produk {
    protected $tanggalKadaluarsa;

    public function __construct($nama, $merek, $harga, $tanggalKadaluarsa) {
        parent::__construct($nama, $merek, $harga);
        $this->tanggalKadaluarsa = $tanggalKadaluarsa;
    }

    public function getInfo() {
        return "Produk: Makanan - {$this->nama}<br>" .
               parent::getInfo() .
               "Tanggal Kadaluarsa: {$this->tanggalKadaluarsa}<br>" .
               "Status: Segar<br>";
    }
}

class Elektronik extends Produk {
    protected $garansi;

    public function __construct($nama, $merek, $harga, $garansi) {
        parent::__construct($nama, $merek, $harga);
        $this->garansi = $garansi;
    }

    public function getInfo() {
        return "Produk: Elektronik - {$this->nama}<br>" .
               parent::getInfo() .
               "Garansi: {$this->garansi} bulan<br>";
    }
}

// --- Eksekusi Program ---
echo "<pre>";

$makanan = new Makanan("Mie Instan", "Indomie", 3500, "2027-06-30");
echo $makanan->getInfo();

echo "<br>";

$elektronik = new Elektronik("Smart TV", "Samsung", 5000000, 12);
echo $elektronik->getInfo();

echo "</pre>";