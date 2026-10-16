<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Services\ProductService;

try {
    $productService = new ProductService();

    $product1 = $productService->createProduct("Laptop Gaming", 15000000);
    $product2 = $productService->createProduct("Mouse Wireless", 250000);

    echo "<h3>Daftar Produk:</h3>";
    echo "<p>" . $productService->displayProduct($product1) . "</p>";
    echo "<p>" . $productService->displayProduct($product2) . "</p>";

} catch (Throwable $e) {
    echo "<h3>Terjadi Error</h3>";
    echo "<p>Pesan: " . $e->getMessage() . "</p>";
    echo "<p>File: " . $e->getFile() . "</p>";
    echo "<p>Line: " . $e->getLine() . "</p>";
}