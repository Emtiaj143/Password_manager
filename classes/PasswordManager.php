<?php
// Classes/PasswordManager.php

class PasswordManager {
    private $db;
    private $encryption_key;

    public function __construct($db) {
        $this->db = $db;
        $this->encryption_key = $_SESSION['encryption_key'];
    }

    public function savePassword($service, $password) {
        $encrypted_password = openssl_encrypt($password, 'AES-256-CBC', $this->encryption_key, 0, $this->getIV());
        $query = "INSERT INTO passwords (user_id, service, password, created_at) VALUES (:user_id, :service, :password, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':service', $service);
        $stmt->bindParam(':password', $encrypted_password);
        return $stmt->execute();
    }

    private function getIV() {
        return substr(hash('sha256', $this->encryption_key), 0, 16);
    }
}
?>
