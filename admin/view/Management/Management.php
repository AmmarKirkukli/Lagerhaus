<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../Lagerhaus/admin/index.php?action=loginAdmin");
    exit(); 
}

include_once(__DIR__ . '/../../model/usersModel/usersModel.php');
$users = (new UserModel())->getAllUsers();

include_once(__DIR__ . '/../../model/productsModel/productsModel.php');
$products = (new ProductModel())->getAllProdukts();

include_once(__DIR__ . '/../../model/OrderModel/OrderModel.php');
$orders = (new OrderModel())->getAllOrders();
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Management Dashboard</h2>
        </div>
        <div class="card-body">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="managementTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#usersTab" type="button" role="tab" aria-controls="usersTab" aria-selected="true">Benutzer</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#productsTab" type="button" role="tab" aria-controls="productsTab" aria-selected="false">Produkte</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#ordersTab" type="button" role="tab" aria-controls="ordersTab" aria-selected="false">Bestellungen</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="managementTabsContent">
                <!-- Users Tab -->
                <div class="tab-pane fade show active" id="usersTab" role="tabpanel" aria-labelledby="users-tab">
                    <a href="../../../../Lagerhaus/admin/index.php?action=userNew" class="btn btn-success mb-3">Neuen Benutzer erstellen</a>
                    <table class="table table-striped table-hover">
                        <thead class="border border-primary rounded">
                            <tr>
                                <th>Vorname</th>
                                <th>Nachname</th>
                                <th>Chip Code</th>
                                <th>Email</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody class="border border-primary rounded">
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr >
                                        <td><?= htmlspecialchars($user['vorname']) ?></td>
                                        <td><?= htmlspecialchars($user['nachname']) ?></td>
                                        <td><?= htmlspecialchars($user['chip_code']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td>
                                            <a href="../../Lagerhaus/admin/index.php?action=userEdit&id=<?= $user['user_id'] ?>" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="../../Lagerhaus/admin/index.php?action=userDelete&id=<?= $user['user_id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Benutzer wirklich löschen?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Keine Benutzer gefunden.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table> 
                </div>

                <!-- Products Tab -->
                <div class="tab-pane fade" id="productsTab" role="tabpanel" aria-labelledby="products-tab">
                    <a href="../../../../Lagerhaus/admin/index.php?action=producteNew" class="btn btn-success mb-3">Neues Produkt erstellen</a>
                    <table class="table table-striped table-hover">
                        <thead class="border border-primary rounded">
                            <tr">
                                <th>Produktname</th>
                                <th>Barcode</th>
                                <th>Preis</th>
                                <th>Menge</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody class="border border-primary rounded">
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                                        <td><?= htmlspecialchars($product['barcode']) ?></td>
                                        <td><?= number_format($product['preis'], 2) ?> €</td>
                                        <td><?= htmlspecialchars($product['menge']) ?></td>
                                        <td>
                                            <a href="../../Lagerhaus/admin/index.php?action=producteEdit&id=<?= $product['product_id'] ?>" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="../../Lagerhaus/admin/index.php?action=producteDelete&id=<?= $product['product_id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Produkt wirklich löschen?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Keine Produkte gefunden.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Orders Tab -->
                <div class="tab-pane fade" id="ordersTab" role="tabpanel" aria-labelledby="orders-tab">
                    <a href="../../../../Lagerhaus/admin/index.php?action=createOrder" class="btn btn-success mb-3">Neue Bestellung erstellen</a>
                    <table class="table table-striped table-hover">
                        <thead class="border border-primary rounded">
                            <tr>
                                <th>Bestellung ID</th>
                                <th>Chip Code</th>
                                <th>Produktname</th>
                                <th>Menge</th>
                                <th>Gesamtpreis</th>
                                <th>Datum</th>
                                <th>Status</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody class="border border-primary rounded">
                            <?php if (!empty($orders)): ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?= $order['order_id'] ?></td>
                                        <td><?= htmlspecialchars($order['chip_code']) ?></td>
                                        <td><?= htmlspecialchars($order['product_name']) ?></td>
                                        <td><?= $order['quantity'] ?></td>
                                        <td><?= number_format($order['quantity'] * 10.00, 2) ?> €</td>
                                        <td><?= $order['order_date'] ?></td>
                                        <td><?= $order['is_paid'] ? 'Bezahlt' : 'Nicht bezahlt' ?></td>
                                        <td>
                                            <a href="../../Lagerhaus/admin/index.php?action=editOrder&id=<?= $order['order_id'] ?>" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="../../Lagerhaus/admin/index.php?action=deleteOrder&id=<?= $order['order_id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bestellung wirklich löschen?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Keine Bestellungen gefunden.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
