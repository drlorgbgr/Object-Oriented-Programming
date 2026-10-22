<?php

require_once __DIR__ . '/../Product.php';

// Fungsi untuk menghapus produk berdasarkan ID.
function deleteProduct(int $id): bool
{
    return Product::delete($id);
}
