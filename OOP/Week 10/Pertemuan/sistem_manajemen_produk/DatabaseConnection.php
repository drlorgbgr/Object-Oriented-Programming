<?php

class DatabaseConnection
{
    private static ?DatabaseConnection $instance = null;
    private PDO $connection;

    // Sesuaikan jika konfigurasi MySQL di komputer berbeda.
    private string $host = 'localhost';
    private string $database = 'manajemen_produk';
    private string $username = 'root';
    private string $password = '';

    private function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";

        $this->connection = new PDO($dsn, $this->username, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    // Mencegah pembuatan objek koneksi dari luar class.
    private function __clone() {}

    public function __wakeup(): void
    {
        throw new RuntimeException('Objek DatabaseConnection tidak dapat di-unserialize.');
    }

    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
