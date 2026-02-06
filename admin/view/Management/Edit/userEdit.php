<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2>Benutzer bearbeiten</h2>
        </div>
        <div class="card-body">
            <?php if ($user): ?>
                <form method="post" action="../admin/index.php?action=userUpdate&id=<?php echo htmlspecialchars($user['user_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="mb-4">
                        <label for="vorname" class="form-label">Vorname</label>
                        <input type="text" 
                               id="vorname" 
                               name="vorname" 
                               class="form-control shadow-sm" 
                               value="<?php echo htmlspecialchars($user['vorname'], ENT_QUOTES, 'UTF-8'); ?>" 
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="nachname" class="form-label">Nachname</label>
                        <input type="text" 
                               id="nachname" 
                               name="nachname" 
                               class="form-control shadow-sm" 
                               value="<?php echo htmlspecialchars($user['nachname'], ENT_QUOTES, 'UTF-8'); ?>" 
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="chip_code" class="form-label">Chip Code</label>
                        <input type="text" 
                               id="chip_code" 
                               name="chip_code" 
                               class="form-control shadow-sm" 
                               value="<?php echo htmlspecialchars($user['chip_code'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                               placeholder="Chip Code">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control shadow-sm" 
                               value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" 
                               required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success px-4">Benutzer aktualisieren</button>
                        <a class="btn btn-secondary px-4" href="../admin/index.php?action=Management">Zurück</a>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-danger text-center">Benutzer nicht gefunden.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
