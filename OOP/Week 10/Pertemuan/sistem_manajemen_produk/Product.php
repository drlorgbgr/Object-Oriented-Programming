<?php

require_once __DIR__ . '/DatabaseConnection.php';

class Product
{
    private int $id = 0;
    private string $nama = '';
    private float $harga = 0;
    private int $stok = 0;
    private PDO $db;

    public function __construct()
    {
        // Memakai satu koneksi PDO yang disediakan oleh Singleton.
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setNama(string $nama): self
    {
        $this->nama = trim($nama);
        return $this;
    }

    public function setHarga(float $harga): self
    {
        $this->harga = $harga;
        return $this;
    }

    public function setStok(int $stok): self
    {
        $this->stok = $stok;
        return $this;
    }

    // CREATE: menyimpan produk baru.
    public function save(): bool
    {
        $sql = 'INSERT INTO produk (nama, harga, stok) VALUES (:nama, :harga, :stok)';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nama' => $this->nama,
            'harga' => $this->harga,
            'stok' => $this->stok,
        ]);
    }

    // READ ALL: mengambil seluruh data produk.
    public static function findAll(): array
    {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->query('SELECT id, nama, harga, stok FROM produk ORDER BY id ASC');

        return $stmt->fetchAll();
    }

    // READ ONE: mengambil satu produk berdasarkan ID.
    public static function findById(int $id): array|false
    {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT id, nama, harga, stok FROM produk WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    // UPDATE: memperbarui produk berdasarkan ID.
    public function update(int $id): bool
    {
        $sql = 'UPDATE produk
                SET nama = :nama, harga = :harga, stok = :stok
                WHERE id = :id';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nama' => $this->nama,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'id' => $id,
        ]);
    }

    // DELETE: menghapus satu produk berdasarkan ID.
    public static function delete(int $id): bool
    {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->prepare('DELETE FROM produk WHERE id = :id');

        return $stmt->execute(['id' => $id]);
    }
}
