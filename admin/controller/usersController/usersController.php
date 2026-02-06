<?php
include_once(__DIR__ . '/../../model/usersModel/usersModel.php');

class UserController {
    public function userEdit(int $user_id): void {
        $userModel = new UserModel();
        $user = $userModel->getUserById($user_id);

        // Überprüfen, ob der Benutzer existiert
        if (!$user) {
            echo "<div class='alert alert-danger'>User not found</div>";
            return;
        }

        include(__DIR__ . '/../../view/Management/Edit/userEdit.php');
    }

    public function userUpdate(int $user_id): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vorname = htmlspecialchars(trim($_POST['vorname']), ENT_QUOTES, 'UTF-8');
            $nachname = htmlspecialchars(trim($_POST['nachname']), ENT_QUOTES, 'UTF-8');
            $chip_code = htmlspecialchars(trim($_POST['chip_code']), ENT_QUOTES, 'UTF-8');
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

            // Validierung der Eingaben
            if (!$vorname || !$nachname || !$chip_code || !$email) {
                echo "<div class='alert alert-danger'>All fields must be valid and non-empty</div>";
                return;
            }

            $userModel = new UserModel();
            $success = $userModel->updateUser($user_id, $vorname, $nachname, $chip_code, $email);

            if ($success) {
                header('Location: ../../../../../Lagerhaus/admin/index.php?action=Management');
                exit();
            } else {
                echo "<div class='alert alert-danger'>Failed to update user</div>";
            }
        }
    }

    public function userDelete(int $user_id): void {
        $userModel = new UserModel();
        $success = $userModel->deleteUser($user_id);

        if ($success) {
            header('Location: ../../../../../Lagerhaus/admin/index.php?action=Management');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to delete user</div>";
        }
    }
}