<?php

require_once __DIR__ . '/../Product.php';

// Fungsi untuk memperbarui produk berdasarkan ID.
function updateProduct(int $id, array $data): bool
{
    $product = new Product();
    $product->setNama((string) $data['nama'])
        ->setHarga((float) $data['harga'])
        ->setStok((int) $data['stok']);

    return $product->update($id);
}
