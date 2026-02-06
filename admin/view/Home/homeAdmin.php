<div class=" p-6 rounded-3">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="row align-items-center mb-2">
            <div class="col-md-8">
                <h1 class="text-primary fw-bold">Kirkukli GmbH</h1>
                <p><a href="https://github.com/AmmarKirkukli" class="text-decoration-none text-secondary fw-bold">Besuchen Sie unsere Webseite</a></p>
                <p class="mb-1">Pinneberger Str. 23-27, 25336 Eloshoen</p>
                <p class="mb-1">Kategorie: <strong>Fachinformatiker</strong></p>
                <p class="mb-1">Telefonnummer: <a href="tel:0433455345345" class="text-secondary">0433455345345</a></p>
                <p class="mb-1">Öffnungszeiten: <span class="badge bg-primary">So. bis Sa.: 24 Stunden geöffnet</span></p>
            </div>
            <div class="col-md-4 text-center">
                <img class="img-fluid" src="../../../../Lagerhaus/admin/public/img/lagerhous6-ohne.png" alt="Logo">
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col text-center">
                <?php if (isset($_SESSION['admin_id'])): ?>
                    <div class="bg-light p-4 rounded shadow">
                        <h2 class="text-primary-emphasis">Willkommen, <?php echo htmlspecialchars($_SESSION['vorname'] . ' ' . $_SESSION['nachname']); ?>!</h2>
                    </div>
                <?php else: ?>
                    <div class="bg-light p-4 rounded shadow">
                        <h2 class="text-warning">Willkommen, Gast!</h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- About Section -->
        <div class="row mb-4">
            <div class="col">
                <p class="lead text-secondary">
                    Die Kirkukli GmbH ist Ihr zuverlässiger IT-Berater mit umfassender Expertise in der Bereitstellung innovativer IT-Lösungen. Unser engagiertes Team von Fachleuten arbeitet eng mit Ihnen zusammen, um maßgeschneiderte Strategien zu entwickeln, die Ihre Geschäftsanforderungen erfüllen und Ihre IT-Infrastruktur optimieren.
                </p>
            </div>
        </div>

        <!-- Details Section -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Über uns</h4>
                        <p class="card-text">Fachinformatiker sind die Allrounder und Spezialisten der digitalen Infrastruktur.</p>
                        <p class="card-text">In ihrer dreijährigen dualen Ausbildung entwickeln sie sich zu Experten, die IT-Systeme nicht nur verstehen, sondern aktiv gestalten, vernetzen und schützen.</p>
                        <a href="https://github.com/AmmarKirkukli" target="_blank" class="btn btn-primary">Mehr erfahren</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Unsere Vision</h4>
                        <p class="card-text">Wir bieten innovative Lösungen für Ihre IT-Bedürfnisse.</p>
                        <p class="card-text">Setzen Sie auf Zuverlässigkeit und Expertise.</p>
                        <a href="https://github.com/AmmarKirkukli" target="_blank" class="btn btn-primary">Besuchen Sie uns</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>