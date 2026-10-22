<?php

require_once __DIR__ . '/../Product.php';

// Fungsi untuk menambahkan produk. Dipanggil oleh index.php.
function createProduct(array $data): bool
{
    $product = new Product();
    $product->setNama((string) $data['nama'])
        ->setHarga((float) $data['harga'])
        ->setStok((int) $data['stok']);

    return $product->save();
}
