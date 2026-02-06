<?php
include_once(__DIR__ . '/../../../model/productsModel/productsModel.php');
include_once(__DIR__ . '/../../../model/Database.php');

$Product = new ProductModel();

$product_id = $_GET['id']; 
$Products = $Product->getProduktsById($product_id);
?>

<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2>Produkt bearbeiten</h2>
        </div>
        <div class="card-body">
            <form method="post" action="../admin/index.php?action=producteUpdate&id=<?php echo $Products['product_id']; ?>">
                <div class="mb-4">
                    <label for="product_name" class="form-label">Produktname:</label>
                    <input type="text" 
                           name="product_name" 
                           id="product_name" 
                           class="form-control shadow-sm" 
                           value="<?php echo htmlspecialchars($Products['product_name']); ?>" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="barcode" class="form-label">Barcode:</label>
                    <input type="number" 
                           name="barcode" 
                           id="barcode" 
                           class="form-control shadow-sm" 
                           value="<?php echo htmlspecialchars($Products['barcode']); ?>" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="preis" class="form-label">Preis (€):</label>
                    <input type="number" 
                           step="0.01" 
                           name="preis" 
                           id="preis" 
                           class="form-control shadow-sm" 
                           value="<?php echo htmlspecialchars($Products['preis']); ?>" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="menge" class="form-label">Menge:</label>
                    <input type="number" 
                           name="menge" 
                           id="menge" 
                           class="form-control shadow-sm" 
                           value="<?php echo htmlspecialchars($Products['menge']); ?>" 
                           required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">Produkt aktualisieren</button>
                    <a href="../../../Lagerhaus/admin/index.php?action=Management" class="btn btn-secondary px-4">Zurück</a>
                </div>
            </form>
        </div>
    </div>
</div>

