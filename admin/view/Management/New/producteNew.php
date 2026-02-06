<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2>Neues Produkt erstellen</h2>
        </div>
        <div class="card-body">
            <form method="post" action="../../../../../Lagerhaus/admin/controller/productsController/createProducts.php">
                <div class="mb-4">
                    <label for="product_name" class="form-label">Produktname:</label>
                    <input type="text" 
                           class="form-control shadow-sm" 
                           name="product_name" 
                           id="product_name" 
                           placeholder="Geben Sie den Produktnamen ein" 
                           required 
                           maxlength="100">
                </div>
                <div class="mb-4">
                    <label for="barcode" class="form-label">Barcode:</label>
                    <input type="text" 
                           class="form-control shadow-sm" 
                           name="barcode" 
                           id="barcode" 
                           placeholder="Geben Sie den Barcode ein" 
                           required 
                           maxlength="100">
                </div>
                <div class="mb-4">
                    <label for="preis" class="form-label">Preis:</label>
                    <input type="number" 
                           class="form-control shadow-sm" 
                           name="preis" 
                           id="preis" 
                           placeholder="Geben Sie den Preis ein" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="menge" class="form-label">Menge:</label>
                    <input type="number" 
                           class="form-control shadow-sm" 
                           name="menge" 
                           id="menge" 
                           placeholder="Geben Sie die Menge ein" 
                           required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success px-5 me-3">Produkt erstellen</button>
                    <a href="../../index.php?action=Management" class="btn btn-secondary px-5">Abbrechen</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const barcodeField = document.getElementById("barcode");
        if (barcodeField) {
            barcodeField.focus();
        }
    });
</script>