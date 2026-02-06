<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../Lagerhaus/admin/index.php?action=loginAdmin");
    exit(); 
}

// Produkt-Daten laden
include_once(__DIR__ . '/../../model/Database.php');
include_once(__DIR__ . '/../../model/productsModel/productsModel.php');
$productModel = new ProductModel();
$products = $productModel->getAllProdukts();
$lowStockProducts = $productModel->getLowStockProducts(); 

// Statistiken berechnen
$totalProducts = count($products);
$totalValue = array_sum(array_map(fn($p) => $p['preis'] * $p['menge'], $products));
$totalStock = array_sum(array_map(fn($p) => $p['menge'], $products));
$lowStockCount = count($lowStockProducts);
?>

<div class="producteSite container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-0 text-primary">
                        <i class="fas fa-box-open me-2"></i>Produktverwaltung
                    </h1>
                    <p class="text-muted mb-0">Verwalten Sie Ihr Lagerbestand und Produkte</p>
                </div>
                <a href="index.php?action=producteNew" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Neues Produkt
                </a>
            </div>
        </div>
    </div>

    <!-- Warnungen für niedrigen Bestand -->
    <?php if ($lowStockCount > 0): ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                    <h5 class="alert-heading">
                        <i class="fas fa-exclamation-triangle me-2"></i>Niedriger Lagerbestand
                    </h5>
                    <p class="mb-0">
                        Es gibt <strong><?= $lowStockCount ?></strong> Produkt(e) mit weniger als 5 Stück auf Lager.
                        Bitte prüfen Sie die Bestände und bestellen Sie rechtzeitig nach.
                    </p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Statistiken -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-boxes fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-title mb-0 text-muted">Gesamt Produkte</h6>
                            <h2 class="mb-0 text-primary"><?= $totalProducts ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-euro-sign fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-title mb-0 text-muted">Gesamtwert</h6>
                            <h2 class="mb-0 text-success"><?= number_format($totalValue, 2, ',', '.') ?> €</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-warehouse fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-title mb-0 text-muted">Gesamt Stück</h6>
                            <h2 class="mb-0 text-info"><?= number_format($totalStock, 0, ',', '.') ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-title mb-0 text-muted">Niedriger Bestand</h6>
                            <h2 class="mb-0 text-warning"><?= $lowStockCount ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produkt-Tabelle -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Alle Produkte</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 ps-0" 
                                       id="searchInput" 
                                       placeholder="Produkt oder Barcode suchen...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="productsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">
                                        <i class="fas fa-hashtag me-2 text-muted"></i>ID
                                    </th>
                                    <th class="py-3">
                                        <i class="fas fa-box me-2 text-muted"></i>Produktname
                                    </th>
                                    <th class="py-3">
                                        <i class="fas fa-barcode me-2 text-muted"></i>Barcode
                                    </th>
                                    <th class="py-3 text-end">
                                        <i class="fas fa-euro-sign me-2 text-muted"></i>Preis
                                    </th>
                                    <th class="py-3 text-center">
                                        <i class="fas fa-cubes me-2 text-muted"></i>Bestand
                                    </th>
                                    <th class="py-3 text-end">
                                        <i class="fas fa-calculator me-2 text-muted"></i>Gesamtwert
                                    </th>
                                    <th class="py-3 text-center">
                                        <i class="fas fa-cogs me-2 text-muted"></i>Aktionen
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($products)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                                            <p class="text-muted mb-0">Keine Produkte gefunden</p>
                                            <a href="index.php?action=producteNew" class="btn btn-sm btn-primary mt-2">
                                                Erstes Produkt erstellen
                                            </a>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($products as $product): ?>
                                        <?php 
                                        $isLowStock = $product['menge'] < 5;
                                        $totalProductValue = $product['preis'] * $product['menge'];
                                        ?>
                                        <tr class="<?= $isLowStock ? 'table-warning' : '' ?>">
                                            <td class="px-4 py-3">
                                                <span class="badge bg-secondary">#<?= htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8') ?></span>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-box rounded bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-box"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">
                                                            <?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?>
                                                        </div>
                                                        <?php if ($isLowStock): ?>
                                                            <small class="text-warning">
                                                                <i class="fas fa-exclamation-triangle"></i> Niedriger Bestand!
                                                            </small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <code class="bg-light px-2 py-1 rounded">
                                                    <?= htmlspecialchars($product['barcode'], ENT_QUOTES, 'UTF-8') ?>
                                                </code>
                                            </td>
                                            <td class="py-3 text-end">
                                                <strong><?= number_format($product['preis'], 2, ',', '.') ?> €</strong>
                                            </td>
                                            <td class="py-3 text-center">
                                                <?php if ($isLowStock): ?>
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-exclamation-circle me-1"></i>
                                                        <?= number_format($product['menge'], 0, ',', '.') ?> Stück
                                                    </span>
                                                <?php elseif ($product['menge'] == 0): ?>
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times-circle me-1"></i>
                                                        Ausverkauft
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        <?= number_format($product['menge'], 0, ',', '.') ?> Stück
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-3 text-end">
                                                <span class="text-muted">
                                                    <?= number_format($totalProductValue, 2, ',', '.') ?> €
                                                </span>
                                            </td>
                                            <td class="py-3 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="index.php?action=producteEdit&id=<?= $product['product_id'] ?>" 
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Bearbeiten">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            onclick="confirmDelete(<?= $product['product_id'] ?>, '<?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?>')"
                                                            title="Löschen">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if (!empty($products)): ?>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                Zeige <strong><?= $totalProducts ?></strong> Produkte
                            </span>
                            <div class="text-muted">
                                <small>Gesamtwert: <strong class="text-success"><?= number_format($totalValue, 2, ',', '.') ?> €</strong></small>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript für Such- und Löschfunktion -->
<script>
// Live-Suche
document.getElementById('searchInput')?.addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#productsTable tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Löschen-Bestätigung
function confirmDelete(productId, productName) {
    if (confirm(`Möchten Sie das Produkt "${productName}" wirklich löschen?\n\nDieser Vorgang kann nicht rückgängig gemacht werden.`)) {
        window.location.href = `index.php?action=producteDelete&id=${productId}`;
    }
}

// Automatische Aktualisierung alle 30 Sekunden (optional)
// setInterval(() => location.reload(), 30000);
</script>

<style>
.icon-box {
    min-width: 40px;
    font-size: 16px;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05) !important;
    transform: scale(1.01);
}

.table-warning {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

code {
    font-size: 0.875rem;
}

.alert {
    border-left: 4px solid #ffc107;
}

@media print {
    .btn, .card-header, .card-footer {
        display: none;
    }
}
</style>
