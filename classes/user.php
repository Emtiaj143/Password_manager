<?php
// classes/User.php

class User {
    private $db;
    private $encryption_key;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $password) {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Generate AES encryption key
        $this->encryption_key = hash('sha256', $password);

        // Insert user into database
        $query = "INSERT INTO users (username, password_hash, encryption_key) VALUES (:username, :password_hash, :encryption_key)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_hash', $password_hash);
        $stmt->bindParam(':encryption_key', $this->encryption_key);

        return $stmt->execute();
    }
}
?>
