<?php
require_once __DIR__ . '/DB/database.php';
require_once __DIR__ . '/Classes/PasswordManager.php';

session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = (new Database())->getConnection();
$manager = new PasswordManager($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST['service'];
    $password = $_POST['password'];
    $manager->savePassword($service, $password);
    echo "Password saved successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stored Passwords</title>
</head>
<body>
    <h2>Save a New Password</h2>
    <form method="POST">
        <label>Service:</label><br>
        <input type="text" name="service" required><br><br>

        <label>Password:</label><br>
        <input type="text" name="password" required><br><br>

        <button type="submit">Save Password</button>
    </form>

    <br><br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
