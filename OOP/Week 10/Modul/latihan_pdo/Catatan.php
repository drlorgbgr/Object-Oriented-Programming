
<?php

require_once 'DatabaseConnection.php';

class Catatan {
    private $id = null;
    private $judul;
    private $isi;
    private $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance()
            ->getConnection();
    }

    public function setJudul($judul) {
        $this->judul = $judul;
        return $this;
    }

    public function setIsi($isi) {
        $this->isi = $isi;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function save() {
        $sql = "INSERT INTO catatan (judul, isi)
                VALUES (:judul, :isi)";

        $stmt = $this->db->prepare($sql);

        $result = $stmt->execute([
            'judul' => $this->judul,
            'isi' => $this->isi
        ]);

        if ($result) {
            $this->id = $this->db->lastInsertId();
        }

        return $result;
    }

    public static function getAll() {
        $db = DatabaseConnection::getInstance()
            ->getConnection();

        $stmt = $db->query(
            "SELECT * FROM catatan ORDER BY id DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = DatabaseConnection::getInstance()
            ->getConnection();

        $stmt = $db->prepare(
            "SELECT * FROM catatan WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id) {
        $sql = "UPDATE catatan
                SET judul = :judul, isi = :isi
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'judul' => $this->judul,
            'isi' => $this->isi,
            'id' => $id
        ]);
    }

    public static function delete($id) {
        $db = DatabaseConnection::getInstance()
            ->getConnection();

        $stmt = $db->prepare(
            "DELETE FROM catatan WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}
