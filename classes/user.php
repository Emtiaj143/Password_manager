<?php
// Classes/User.php

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

    public function login($username, $password) {
        // Fetch user by username
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['password_hash'])) {
            // Store user data in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['encryption_key'] = $user['encryption_key'];
            return true;
        }

        return false;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}
?>
