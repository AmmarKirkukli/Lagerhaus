<?php session_start(); ?>
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand ms-3 fw-bold" href="./index.php?action=homeAdmin">
            <img src="../../../../Lagerhaus/admin/public/img/lagerhous5.jpg" alt="Logo" style="width: 130px; height: 70px;" class=" me-3">
            Admin Dashboard
        </a>
        
        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <?php if (isset($_SESSION['admin_id'])): ?>
                <?php else: ?>
                    <li class="nav-item me-3">
                        <a class="nav-link active text-white" href="./index.php?action=loginAdmin">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-white" href="./index.php?action=homeAdmin">
                        <i class="fas fa-home me-2"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./index.php?action=Users">
                        <i class="fas fa-users me-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./index.php?action=Products">
                        <i class="fas fa-box me-2"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./index.php?action=listAllOrders">
                        <i class="fas fa-receipt me-2"></i> Management
                    </a>
                </li>

                <?php if (isset($_SESSION['admin_id'])): ?>
                    <li class="nav-item me-3">
                            <a class="nav-link active text-white" href="index.php?action=profileAdmin">
                                <i class="fas fa-user-circle me-2"></i>
                                <?php echo htmlspecialchars($_SESSION['vorname'] . ' ' . $_SESSION['nachname']); ?>
                            </a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['admin_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./index.php?action=logoutAdmin">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
