<?php
include_once(__DIR__ . '/../Database.php');
class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createOrder($chipCode, $barcode, $productName, $productId, $quantity, $isPaid) {
        $this->db->query("INSERT INTO orders (chip_code, barcode, product_name, product_id, quantity, is_paid) 
                          VALUES (:chip_code, :barcode, :product_name, :product_id, :quantity, :is_paid)");
        $this->db->bind(':chip_code', $chipCode);
        $this->db->bind(':barcode', $barcode);
        $this->db->bind(':product_name', $productName);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':is_paid', $isPaid);

        return $this->db->execute();
    }

    public function getUserEmailByChipCode($chipCode) {
        $this->db->query("SELECT email FROM users WHERE chip_code = :chip_code");
        $this->db->bind(':chip_code', $chipCode);
        $result = $this->db->single();
        
        return $result ? $result['email'] : null;
    } 
  
    public function updateOrder($orderId, $chipCode, $barcode, $productName, $productId, $quantity, $isPaid) {
        $this->db->query("UPDATE orders 
                          SET chip_code = :chip_code, barcode = :barcode, product_name = :product_name, 
                              product_id = :product_id, quantity = :quantity, is_paid = :is_paid 
                          WHERE order_id = :order_id");
        $this->db->bind(':chip_code', $chipCode);
        $this->db->bind(':barcode', $barcode);
        $this->db->bind(':product_name', $productName);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':is_paid', $isPaid);
        $this->db->bind(':order_id', $orderId);

        return $this->db->execute();
    }

    public function deleteOrderById($orderId) {
        $this->db->query("DELETE FROM orders WHERE order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->execute();
    }
    
    public function getUnpaidOrdersOlderThanTwoWeeks() {
        $this->db->query("
            SELECT o.*, u.email, u.vorname, u.nachname
            FROM orders o
            JOIN users u ON o.chip_code = u.chip_code
            WHERE o.is_paid = 0
              AND o.order_date <= DATE_SUB(NOW(), INTERVAL 2 WEEK)
        ");
        return $this->db->resultSet();
    }
    
    public function getOrderById($orderId) {
        $this->db->query("SELECT * FROM orders WHERE order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->single();
    }

    public function getAllOrders() {
        $this->db->query("SELECT * FROM orders");
        return $this->db->resultSet();
    }
}