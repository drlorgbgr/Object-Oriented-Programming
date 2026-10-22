<?php

require_once __DIR__ . '/../Product.php';

// Fungsi untuk mengambil seluruh data produk.
function readAllProducts(): array
{
    return Product::findAll();
}
