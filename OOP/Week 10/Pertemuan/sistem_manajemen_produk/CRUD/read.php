<?php

require_once __DIR__ . '/../Product.php';

// Fungsi untuk mengambil satu produk berdasarkan ID.
function readProduct(int $id): array|false
{
    return Product::findById($id);
}
