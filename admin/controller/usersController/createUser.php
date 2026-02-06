<?php
require_once(__DIR__ . '/../../model/usersModel/usersModel.php');
require_once(__DIR__ . '/../../model/Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vorname = filter_input(INPUT_POST, 'vorname', FILTER_SANITIZE_STRING);
    $nachname = filter_input(INPUT_POST, 'nachname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $chip_code = filter_input(INPUT_POST, 'chip_code', FILTER_SANITIZE_NUMBER_INT);

    // Validierung
    if (!empty($vorname) && !empty($nachname) && $email && $chip_code) {
        $userModel = new UserModel();
        $data = [
            'vorname' => $vorname,
            'nachname' => $nachname,
            'email' => $email,
            'chip_code' => $chip_code,
        ];

        if ($userModel->createUser($data)) {
            header('Location: ../../index.php?action=Management');
            exit;
        } else {
            echo '<div class="alert alert-danger">Error creating the user. Please try again.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Invalid input. Please ensure all fields are filled correctly.</div>';
    }
}