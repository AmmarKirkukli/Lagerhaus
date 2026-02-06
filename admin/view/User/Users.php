<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../Lagerhaus/admin/index.php?action=loginAdmin");
    exit(); 
}

// Benutzer-Daten laden
include_once(__DIR__ . '/../../model/usersModel/usersModel.php');
$userModel = new UserModel();
$users = $userModel->getAllUsers();
?>

<div class="usersite container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-0 text-primary">
                        <i class="fas fa-users me-2"></i>Benutzerverwaltung
                    </h1>
                    <p class="text-muted mb-0">Verwalten Sie alle registrierten Benutzer</p>
                </div>
                <a href="index.php?action=userNew" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Neuer Benutzer
                </a>
            </div>
        </div>
    </div>

    <!-- Statistiken -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-0">Gesamt Benutzer</h5>
                            <h2 class="mb-0 text-primary"><?= count($users) ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-id-card fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-0">Aktive Chips</h5>
                            <h2 class="mb-0 text-success"><?= count(array_filter($users, fn($u) => !empty($u['chip_code']))) ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-envelope fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-0">Verifizierte E-Mails</h5>
                            <h2 class="mb-0 text-info"><?= count(array_filter($users, fn($u) => !empty($u['email']))) ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benutzer-Tabelle -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Alle Benutzer</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 ps-0" 
                                       id="searchInput" 
                                       placeholder="Benutzer suchen...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="usersTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-3 py-3">
                                        <i class="fas fa-hashtag me-2 text-muted"></i>ID
                                    </th>
                                    <th class="px-3 py-3">
                                        <i class="fas fa-user me-2 text-muted"></i>Name
                                    </th>
                                    <th class="px-3 py-3">
                                        <i class="fas fa-envelope me-2 text-muted"></i>E-Mail
                                    </th>
                                    <th class="px-3 py-3">
                                        <i class="fas fa-id-card me-2 text-muted"></i>Chip-Code
                                    </th>
                                    <th class="px-3 py-3 text-center">
                                        <i class="fas fa-cogs me-2 text-muted"></i>Aktionen
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($users)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                                            <p class="text-muted mb-0">Keine Benutzer gefunden</p>
                                            <a href="index.php?action=createUser" class="btn btn-sm btn-primary mt-2">
                                                Ersten Benutzer erstellen
                                            </a>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td class="px-3 py-3 ">
                                                <span class="badge bg-secondary">#<?= htmlspecialchars($user['user_id'], ENT_QUOTES, 'UTF-8') ?></span>
                                            </td>
                                            <td class="px-3 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 40px; height: 40px; font-weight: bold; flex-shrink: 0; line-height: 1; font-size: 14px; padding: 5px;">
                                                        <?= strtoupper(substr($user['vorname'], 0, 1)) . strtoupper(substr($user['nachname'], 0, 1)) ?>
                                                    </div>
                                                    <div class="fw-semibold">
                                                        <?= htmlspecialchars($user['vorname'] . ' ' . $user['nachname'], ENT_QUOTES, 'UTF-8') ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3 py-3">
                                                <a href="mailto:<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" 
                                                   class="text-decoration-none text-dark">
                                                    <?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>
                                                </a>
                                            </td>
                                            <td class="px-3 py-3">
                                                <?php if (!empty($user['chip_code'])): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        <?= htmlspecialchars($user['chip_code'], ENT_QUOTES, 'UTF-8') ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                                        Kein Chip
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-3 py-3 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="index.php?action=userEdit&id=<?= $user['user_id'] ?>" 
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Bearbeiten">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            onclick="confirmDelete(<?= $user['user_id'] ?>, '<?= htmlspecialchars($user['vorname'] . ' ' . $user['nachname'], ENT_QUOTES, 'UTF-8') ?>')"
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
                <?php if (!empty($users)): ?>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                Zeige <strong><?= count($users) ?></strong> Benutzer
                            </span>
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
    const tableRows = document.querySelectorAll('#usersTable tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Löschen-Bestätigung
function confirmDelete(userId, userName) {
    if (confirm(`Möchten Sie den Benutzer "${userName}" wirklich löschen?\n\nDieser Vorgang kann nicht rückgängig gemacht werden.`)) {
        window.location.href = `index.php?action=userDelete&id=${userId}`;
    }
}
</script>

