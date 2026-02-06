<?php
include_once(__DIR__ . '/../../model/productsModel/productsModel.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel(); 
    }

    public function editProduct(int $product_id): void {
        $product = $this->model->getProduktsById($product_id);
        include(__DIR__ . '/../../view/Management/Edit/producteEdit.php');
    }

    public function updateProduct(int $product_id): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
            $barcode = htmlspecialchars($_POST['barcode'], ENT_QUOTES, 'UTF-8');
            $preis = htmlspecialchars($_POST['preis'], ENT_QUOTES, 'UTF-8');
            $menge = htmlspecialchars($_POST['menge'], ENT_QUOTES, 'UTF-8');

            $this->model->updateProduct($product_id, $product_name, $barcode, $preis, $menge);
            header('Location: ../../../../../Lagerhaus/admin/index.php?action=Management');
        }
    }

    public function deleteProduct(int $product_id): void {
        $this->model->deleteProduct($product_id);
        header('Location: /../../Lagerhaus/admin/index.php?action=Management');
    }

    public function sendLowStockAlerts() {
        $lowStockProducts = $this->model->getLowStockProducts();
    
        if (empty($lowStockProducts)) {
            echo "";
            // echo "Keine Produkte mit niedrigem Bestand gefunden.";
            return;
        }

        require_once __DIR__ . '/../../../vendor/autoload.php'; 
    
        foreach ($lowStockProducts as $product) {
            try {
                $this->sendLowStockEmail($product);
                echo "Warnung für Produkt ID {$product['product_id']} wurde gesendet.<br>";
            } catch (Exception $e) {
                error_log("Fehler beim Senden der Bestandswarnung: " . $e->getMessage());
            }
        }
    }

    private function sendLowStockEmail($product) {
        $mail = new PHPMailer(true);
    
        try {
            // SMTP-Einstellungen
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@example.com';
            $mail->Password = 'your-email-password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            // Empfänger
            $mail->setFrom('no-reply@lagerhaus.com', 'Lagerhaus');
            $mail->addAddress('admin@example.com'); // Empfänger-Adresse
    
            // Inhalt
            $mail->isHTML(true);
            $mail->Subject = "Warnung: Niedriger Bestand für Produkt {$product['product_name']}";
            $mail->Body = "
                <p>Das Produkt <strong>{$product['product_name']}</strong> hat einen niedrigen Bestand:</p>
                <ul>
                    <li><strong>Produktnummer:</strong> {$product['product_id']}</li>
                    <li><strong>Barcode:</strong> {$product['barcode']}</li>
                    <li><strong>Aktueller Bestand:</strong> {$product['menge']}</li>
                </ul>
                <p>Bitte überprüfen und gegebenenfalls nachbestellen.</p>
            ";
    
            $mail->send();
        } catch (Exception $e) {
            throw new Exception("E-Mail konnte nicht gesendet werden: {$mail->ErrorInfo}");
        }
    }
}
