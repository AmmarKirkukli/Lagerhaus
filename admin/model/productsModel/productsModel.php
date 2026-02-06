<?php
class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllProdukts() {
        $this->db->query('SELECT * FROM products ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getProductByBarcode($barcode) {
        $this->db->query("SELECT * FROM products WHERE barcode = :barcode");
        $this->db->bind(':barcode', $barcode);
        return $this->db->single();
    }

    public function getProduktsById($product_id) {
        $this->db->query('SELECT * FROM products WHERE product_id = :product_id');
        $this->db->bind(':product_id', $product_id);
        return $this->db->single();
    }

    public function createProduct(array $data): bool {
        $this->db->query("INSERT INTO products (product_name, barcode, preis, menge) VALUES (:product_name, :barcode, :preis, :menge)");
        $this->db->bind(':product_name', $data['product_name']);
        $this->db->bind(':barcode', $data['barcode']);
        $this->db->bind(':preis', $data['preis']);
        $this->db->bind(':menge', $data['menge']);
        return $this->db->execute();
    }   
    
    public function updateProduct(int $product_id, string $product_name, string $barcode, float $preis, int $menge): bool {
        $this->db->query("UPDATE products 
                          SET product_name = :product_name, barcode = :barcode, preis = :preis, menge = :menge 
                          WHERE product_id = :product_id");
        $this->db->bind(':product_id', $product_id);
        $this->db->bind(':product_name', $product_name);
        $this->db->bind(':barcode', $barcode);
        $this->db->bind(':preis', $preis);
        $this->db->bind(':menge', $menge);
        return $this->db->execute();
    }

    public function deleteProduct($product_id) {
        $this->db->query("DELETE FROM products WHERE product_id = :product_id");
        $this->db->bind(':product_id', $product_id);
        return $this->db->execute();
    }

    public function getLowStockProducts() {
        $this->db->query("SELECT * FROM products WHERE menge < 5");
        return $this->db->resultSet();
    }
    
}
