<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2>Neue Bestellung erstellen</h2>
        </div>
        <div class="card-body">
            <form method="post" action="http://localhost/Lagerhaus/admin/index.php?action=createOrder">
                <div class="mb-4">
                    <label for="chip_code" class="form-label">Chip Code:</label>
                    <input type="text" class="form-control shadow-sm" name="chip_code" id="chip_code" required>
                </div>
                <div class="mb-4">
                    <label for="barcode" class="form-label">Barcode:</label>
                    <input type="text" class="form-control shadow-sm" name="barcode" id="barcode" required>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="form-label">Menge:</label>
                    <input type="number" class="form-control shadow-sm" name="quantity" id="quantity" required>
                </div>
                <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" name="is_paid" id="is_paid">
                    <label class="form-check-label" for="is_paid">Bezahlt</label>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success px-5 me-3">Bestellung erstellen</button>
                    <a href="http://localhost/Lagerhaus/admin/index.php?action=listAllOrders" class="btn btn-secondary px-5">Abbrechen</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chipCodeField = document.getElementById("chip_code");
        if (chipCodeField) {
            chipCodeField.focus(); 
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const barcodeField = document.getElementById("barcode");
        if (barcodeField) {
            barcodeField.focus(); // Setzt den Fokus auf das Barcode-Eingabefeld
        }
    });
</script>