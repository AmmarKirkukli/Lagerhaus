<?php
include_once(__DIR__ . '/../Database.php'); 

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllUsers(): array {
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet(); 
    }

    public function getUserById(int $user_id): ?array {
        $this->db->query('SELECT * FROM users WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id, PDO::PARAM_INT);
        $result = $this->db->single(); 
        return $result ?: null;
    }

    public function updateUser(int $user_id, string $vorname, string $nachname, string $chip_code, string $email): bool {
        $this->db->query('UPDATE users SET vorname = :vorname, nachname = :nachname, chip_code = :chip_code, email = :email WHERE user_id = :user_id');
        $this->db->bind(':vorname', $vorname, PDO::PARAM_STR);
        $this->db->bind(':nachname', $nachname, PDO::PARAM_STR);
        $this->db->bind(':chip_code', $chip_code, PDO::PARAM_STR);
        $this->db->bind(':email', $email, PDO::PARAM_STR);
        $this->db->bind(':user_id', $user_id, PDO::PARAM_INT);
        return $this->db->execute(); 
    }

    public function createUser(array $data): bool {
        $this->db->query('INSERT INTO users (vorname, nachname, chip_code, email) VALUES (:vorname, :nachname, :chip_code, :email)');
        $this->db->bind(':vorname', $data['vorname'], PDO::PARAM_STR);
        $this->db->bind(':nachname', $data['nachname'], PDO::PARAM_STR);
        $this->db->bind(':chip_code', $data['chip_code'], PDO::PARAM_STR);
        $this->db->bind(':email', $data['email'], PDO::PARAM_STR);
        return $this->db->execute();
    }

    public function deleteUser(int $user_id): bool {
        $this->db->query('DELETE FROM users WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id, PDO::PARAM_INT);
        return $this->db->execute();
    }
}
