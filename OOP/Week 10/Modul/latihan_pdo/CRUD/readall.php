<?php
require_once '../Catatan.php';

$data = Catatan::getAll();

foreach ($data as $item) {
    echo $item['id'] . ". " . $item['judul'] . " - "
        . $item['isi'] . PHP_EOL;
}