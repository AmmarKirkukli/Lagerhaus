<?php
include_once(__DIR__ . '/../Database.php');

class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function verifyAdminCredentials($email, $password) {
        $this->db->query("SELECT * FROM admins WHERE email = :email");
        $this->db->bind(':email', $email);
        $result = $this->db->single();

        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return false;
    }

    public function createAdmin($vorname, $nachname, $email, $password, $chipCod): bool {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->db->query("INSERT INTO admins (vorname, nachname, email, password, chipCod) 
                          VALUES (:vorname, :nachname, :email, :password, :chipCod)");
        $this->db->bind(':vorname', $vorname);
        $this->db->bind(':nachname', $nachname);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':chipCod', $chipCod);

        return $this->db->execute();
    }
}

