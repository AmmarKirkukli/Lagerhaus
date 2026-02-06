<?php
require_once(__DIR__ . '/../../model/productsModel/productsModel.php');
require_once(__DIR__ . '/../../model/Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
    $barcode = filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING);
    $preis = filter_input(INPUT_POST, 'preis', FILTER_SANITIZE_STRING);
    $menge = filter_input(INPUT_POST, 'menge', FILTER_SANITIZE_STRING);

    if ($product_name && $barcode && $preis && $menge) {
        $productModel = new ProductModel();
        $data = [
            'product_name' => $product_name,
            'barcode' => $barcode,
            'preis' => $preis,
            'menge' => $menge,
        ];

        if ($productModel->createProduct($data)) {
            header('Location: ../../index.php?action=Management');
            exit;
        } else {
            echo '<div class="alert alert-danger">Error creating the product. Please try again.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Please provide valid title and content.</div>';
    }
}
?>