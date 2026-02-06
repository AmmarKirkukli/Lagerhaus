<div class="container py-5">
    <!-- Admin Login Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h1 class="text-center text-primary">Admin Login</h1>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <form action="../../../../Lagerhaus/admin/controller/adminController/adminController.php?action=login" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail eingeben" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Passwort:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Passwort eingeben" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Neues Admin-Konto erstellen Section -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h2 class="text-center text-success">Neues Admin-Konto erstellen</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="../../../../Lagerhaus/admin/controller/adminController/adminController.php?action=createAdmin">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vorname" class="form-label">Vorname:</label>
                                <input type="text" class="form-control" name="vorname" id="vorname" placeholder="Vorname eingeben" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nachname" class="form-label">Nachname:</label>
                                <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname eingeben" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail eingeben" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Passwort:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Passwort eingeben" required>
                        </div>
                        <div class="mb-3">
                            <label for="chipCod" class="form-label">Chip Code:</label>
                            <input type="text" class="form-control" name="chipCod" id="chipCod" placeholder="Chip Code eingeben" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Admin erstellen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chipCodeField = document.getElementById("chipCod");
        if (chipCodeField) {
            chipCodeField.focus(); 
        }
    });
</script>