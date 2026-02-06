<?php
include_once(__DIR__ . '/../../model/OrderModel/OrderModel.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class OrderController {
    private $model;

    public function __construct() {
        $this->model = new OrderModel();
    }

    public function createOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $chipCode = htmlspecialchars(trim($_POST['chip_code']));
            $barcode = htmlspecialchars(trim($_POST['barcode']));
            $quantity = htmlspecialchars(trim($_POST['quantity']));
            $isPaid = isset($_POST['is_paid']) ? 1 : 0;
    
            $userEmail = $this->model->getUserEmailByChipCode($chipCode);
            if (!$userEmail) {
                echo '<div class="alert alert-danger">Benutzer mit diesem Chip-Code nicht gefunden.</div>';
                return;
            }
    
            // Produkt basierend auf Barcode suchen
            $productModel = new ProductModel();
            $product = $productModel->getProductByBarcode($barcode);
            if (!$product) {
                echo '<div class="alert alert-danger">Produkt mit diesem Barcode nicht gefunden.</div>';
                return;
            }
    
            // Verfügbare Menge prüfen
            if ($quantity > $product['menge']) {
                echo '<div class="alert alert-danger">Die gewünschte Menge übersteigt den verfügbaren Bestand.</div>';
                return;
            }
    
            // Bestellung erstellen
            if ($this->model->createOrder($chipCode, $barcode, $product['product_name'], $product['product_id'], $quantity, $isPaid)) {
                // Produktmenge aktualisieren
                $newMenge = $product['menge'] - $quantity;
                $productModel->updateProduct($product['product_id'], $product['product_name'], $product['barcode'], $product['preis'], $newMenge);
    
                // E-Mail senden
                $orderDetails = [
                    'chip_code' => $chipCode,
                    'barcode' => $barcode,
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'quantity' => $quantity,
                ];
                try {
                    $this->sendOrderEmail($userEmail, $orderDetails);
                } catch (Exception $e) {
                    error_log("E-Mail-Fehler: " . $e->getMessage());
                }
    
                header('Location: ../../../../Lagerhaus/admin/index.php?action=Management');
                exit();
            } else {
                echo '<div class="alert alert-danger">Fehler beim Erstellen der Bestellung.</div>';
            }
        } else {
            include(__DIR__ . '/../../view/Management/New/createOrder.php');
        }
    }
    
    
    public function sendReminderEmails() {
        $unpaidOrders = $this->model->getUnpaidOrdersOlderThanTwoWeeks();
    
        if (empty($unpaidOrders)) {
            echo "";
            // echo "Keine unbezahlten Bestellungen gefunden, die älter als zwei Wochen sind.";
            return;
        }
    
        require_once __DIR__ . '/../../../vendor/autoload.php'; 
    
        foreach ($unpaidOrders as $order) {
            $userEmail = $order['email'];
            $orderDetails = [
                'chip_code' => $order['chip_code'],
                'order_id' => $order['order_id'],
                'product_name' => $order['product_name'],
                'quantity' => $order['quantity'],
                'order_date' => $order['order_date']
            ];
    
            try {
                $this->sendReminderEmail($userEmail, $orderDetails);
                echo "Erinnerung für Bestellung ID {$order['order_id']} wurde gesendet.<br>";
            } catch (Exception $e) {
                error_log("Fehler beim Senden der E-Mail: " . $e->getMessage());
            }
        }
    }
    
    private function sendReminderEmail($userEmail, $orderDetails) {
        $mail = new PHPMailer(true);
    
        try {
           
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@example.com';
            $mail->Password = 'your-email-password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
        
            $mail->setFrom('no-reply@lagerhaus.com', 'Lagerhaus');
            $mail->addAddress($userEmail);
    
     
            $mail->isHTML(true);
            $mail->Subject = "Zahlungserinnerung für Bestellung {$orderDetails['order_id']}";
            $mail->Body = "
                <p>Sehr geehrte/r {$orderDetails['chip_code']},</p>
                <p>Ihre Bestellung vom {$orderDetails['order_date']} mit folgenden Details ist noch unbezahl:</p>
                <ul>
                    <li><strong>Produktname:</strong> {$orderDetails['product_name']}</li>
                    <li><strong>Menge:</strong> {$orderDetails['quantity']}</li>
                </ul>
                <p>Bitte begleichen Sie die Zahlung innerhalb der nächsten 7 Tage.</p>
                <p>Mit freundlichen Grüßen,<br>Lagerhaus-Team</p>
            ";
    
            $mail->send();
        } catch (Exception $e) {
            throw new Exception("E-Mail konnte nicht gesendet werden: {$mail->ErrorInfo}");
        }
    }
    

    public function sendOrderEmail($userEmail, $orderDetails) {
        require_once __DIR__ . '/../../../vendor/autoload.php';

        $mail = new PHPMailer(true);

        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-danger'>Ungültige E-Mail-Adresse.</div>";
            return;
        }

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@example.com';
            $mail->Password = 'your-email-password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@lagerhaus.com', 'Lagerhaus');
            $mail->addAddress($userEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Ihre Bestellung bei Lagerhaus';
            $mail->Body = "
                <h1>Vielen Dank für Ihre Bestellung!</h1>
                <ul>
                    <li>Chip Code: {$orderDetails['chip_code']}</li>
                    <li>Barcode: {$orderDetails['barcode']}</li>
                    <li>Produktname: {$orderDetails['product_name']}</li>
                    <li>Produktnummer: {$orderDetails['product_id']}</li>
                    <li>Menge: {$orderDetails['quantity']}</li>
                </ul>
            ";

            $mail->send();
        } catch (Exception $e) {
            throw new Exception("E-Mail konnte nicht gesendet werden: {$mail->ErrorInfo}");
        }
    }

    public function editOrder($orderId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $chipCode = htmlspecialchars(trim($_POST['chip_code'] ?? ''));
            $barcode = htmlspecialchars(trim($_POST['barcode'] ?? ''));
            $productName = htmlspecialchars(trim($_POST['product_name'] ?? ''));
            $productId = htmlspecialchars(trim($_POST['product_id'] ?? ''));
            $quantity = htmlspecialchars(trim($_POST['quantity'] ?? ''));
            $isPaid = isset($_POST['is_paid']) ? 1 : 0;
    
            // Validierung der Eingaben
            if (empty($chipCode) || empty($barcode) || empty($productName) || empty($productId) || $quantity <= 0) {
                echo '<div class="alert alert-danger">Bitte füllen Sie alle Felder korrekt aus.</div>';
                return;
            }
    
            // Aktualisierung in der Datenbank
            if ($this->model->updateOrder($orderId, $chipCode, $barcode, $productName, $productId, $quantity, $isPaid)) {
                header('Location: /../../../../Lagerhaus/admin/index.php?action=Management');
                exit();
            } else {
                echo '<div class="alert alert-danger">Fehler beim Bearbeiten der Bestellung.</div>';
            }
        } else {
            // Bestellung laden
            $order = $this->model->getOrderById($orderId);
            include(__DIR__ . '/../../view/Management/Edit/editOrder.php');
        }
    }
    

    public function deleteOrder($orderId) {
        if ($this->model->deleteOrderById($orderId)) {
            header('Location: ../../../../Lagerhaus/admin/index.php?action=Management'); 
            exit();
        } else {
            echo '<div class="alert alert-danger">Fehler beim Löschen der Bestellung.</div>';
        }
    }

    public function listAllOrders() {
        $orders = $this->model->getAllOrders(); 
        if (!$orders) {
            echo '<div class="alert alert-warning">Keine Bestellungen gefunden.</div>';
        }
        include(__DIR__ . '/../../view/Management/Management.php'); 
    }
}
