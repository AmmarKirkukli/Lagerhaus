<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-4">
            <h2 class="mb-0">Bestellung bearbeiten</h2>
        </div>
        <div class="card-body p-4">
            <?php if (isset($order)): ?>
                <form method="post" action="http://localhost/Lagerhaus/admin/index.php?action=editOrder&id=<?= $order['order_id'] ?>">
                    <div class="mb-4">
                        <label for="chip_code" class="form-label fw-semibold">Chip Code:</label>
                        <input type="text" 
                               class="form-control form-control-lg shadow-sm rounded" 
                               name="chip_code" 
                               id="chip_code" 
                               value="<?= htmlspecialchars($order['chip_code']) ?>" 
                               placeholder="Chip Code eingeben"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="barcode" class="form-label fw-semibold">Barcode:</label>
                        <input type="text" 
                               class="form-control form-control-lg shadow-sm rounded" 
                               name="barcode" 
                               id="barcode" 
                               value="<?= htmlspecialchars($order['barcode']) ?>" 
                               placeholder="Barcode eingeben"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label fw-semibold">Produktname:</label>
                        <input type="text" 
                               class="form-control form-control-lg shadow-sm rounded" 
                               name="product_name" 
                               id="product_name" 
                               value="<?= htmlspecialchars($order['product_name'] ?? '') ?>" 
                               placeholder="Produktname eingeben"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="product_id" class="form-label fw-semibold">Produktnummer:</label>
                        <input type="number" 
                               class="form-control form-control-lg shadow-sm rounded" 
                               name="product_id" 
                               id="product_id" 
                               value="<?= htmlspecialchars($order['product_id'] ?? '') ?>" 
                               placeholder="Produktnummer eingeben"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="form-label fw-semibold">Menge:</label>
                        <input type="number" 
                               class="form-control form-control-lg shadow-sm rounded" 
                               name="quantity" 
                               id="quantity" 
                               value="<?= htmlspecialchars($order['quantity']) ?>" 
                               placeholder="Menge eingeben"
                               required>
                    </div>
                    <div class="form-check mb-4">
                        <input type="checkbox" 
                               class="form-check-input" 
                               name="is_paid" 
                               id="is_paid" 
                               <?= $order['is_paid'] ? 'checked' : '' ?>>
                        <label class="form-check-label fw-semibold" for="is_paid">Bezahlt</label>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-success btn-lg shadow px-5">Speichern</button>
                        <a href="http://localhost/Lagerhaus/admin/index.php?action=listAllOrders" class="btn btn-secondary btn-lg shadow px-5">Abbrechen</a>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-danger text-center my-4">
                    Die Bestellung konnte nicht geladen werden.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>