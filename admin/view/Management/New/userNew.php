<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2>Neuen Benutzer erstellen</h2>
        </div>
        <div class="card-body">
            <form method="post" action="../../../../../Lagerhaus/admin/controller/usersController/createUser.php">
                <div class="mb-4">
                    <label for="vorname" class="form-label">Vorname:</label>
                    <input type="text" 
                           class="form-control shadow-sm" 
                           name="vorname" 
                           id="vorname" 
                           placeholder="Geben Sie den Vornamen ein" 
                           required 
                           maxlength="50">
                </div>
                <div class="mb-4">
                    <label for="nachname" class="form-label">Nachname:</label>
                    <input type="text" 
                           class="form-control shadow-sm" 
                           name="nachname" 
                           id="nachname" 
                           placeholder="Geben Sie den Nachnamen ein" 
                           required 
                           maxlength="50">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">E-Mail:</label>
                    <input type="email" 
                           class="form-control shadow-sm" 
                           name="email" 
                           id="email" 
                           placeholder="Geben Sie die E-Mail-Adresse ein" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="chip_code" class="form-label">Chip Code:</label>
                    <input type="number" 
                           class="form-control shadow-sm" 
                           name="chip_code" 
                           id="chip_code" 
                           placeholder="Geben Sie den Chip Code ein" 
                           required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success px-5 me-3">Benutzer erstellen</button>
                    <a href="../../index.php?action=Management" class="btn btn-secondary px-5">Abbrechen</a>
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
</script>