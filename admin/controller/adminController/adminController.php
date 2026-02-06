<?php
include_once(__DIR__ . '/../../model/adminModel/AdminModel.php');

class AdminController {
    private $model;

    public function __construct() {
        $this->model = new AdminModel();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            $admin = $this->model->verifyAdminCredentials($email, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['vorname'] = $admin['vorname'];
                $_SESSION['nachname'] = $admin['nachname'];
                header('Location: ../../index.php?action=home');
                exit();
            } else {
                echo '<div class="alert alert-danger">Ungültiger Benutzername oder Passwort.</div>';
                include(__DIR__ . '/../../view/admin/login_view.php');
            }
        } else {
            include(__DIR__ . '/../../view/admin/login_view.php');
        }
    }

    
    public function createAdmin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vorname = htmlspecialchars(trim($_POST['vorname']));
            $nachname = htmlspecialchars(trim($_POST['nachname']));
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = htmlspecialchars(trim($_POST['password']));
            $chipCod = htmlspecialchars(trim($_POST['chipCod']));

            if (!empty($vorname) && !empty($nachname) && $email && !empty($password) && !empty($chipCod)) {
                if ($this->model->createAdmin($vorname, $nachname, $email, $password, $chipCod)) {
                    header('Location: ../../index.php?action=adminList');
                    exit();
                } else {
                    echo '<div class="alert alert-danger">Fehler beim Erstellen des Admin-Kontos.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Bitte füllen Sie alle Felder korrekt aus.</div>';
            }
        } else {
            echo '<div class="alert alert-warning">Nur POST-Anfragen sind erlaubt.</div>';
        }
    }
}

// Router-Logik für verschiedene Aktionen
if (isset($_GET['action'])) {
    $controller = new AdminController();

    switch ($_GET['action']) {
        case 'createAdmin':
            $controller->createAdmin();
            break;

        case 'login':
            $controller->login();
            break;
        default:
            echo '<div class="alert alert-danger">Ungültige Aktion.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Keine Aktion angegeben.</div>';
}
