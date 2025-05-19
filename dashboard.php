<?php
require_once __DIR__ . '/DB/database.php';
require_once __DIR__ . '/Classes/User.php';
require_once __DIR__ . '/Classes/PasswordGenerator.php';

session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$generated_password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $length = $_POST['length'] ?? 12;
    $uppercase = $_POST['uppercase'] ?? 2;
    $lowercase = $_POST['lowercase'] ?? 4;
    $numbers = $_POST['numbers'] ?? 3;
    $special = $_POST['special'] ?? 3;

    $generated_password = PasswordGenerator::generate($length, $uppercase, $lowercase, $numbers, $special);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>

    <h3>Generate Password</h3>
    <form method="POST">
        <label>Length:</label>
        <input type="number" name="length" value="12" min="6" max="32"><br><br>
        
        <label>Uppercase:</label>
        <input type="number" name="uppercase" value="2" min="0" max="32"><br><br>
        
        <label>Lowercase:</label>
        <input type="number" name="lowercase" value="4" min="0" max="32"><br><br>
        
        <label>Numbers:</label>
        <input type="number" name="numbers" value="3" min="0" max="32"><br><br>
        
        <label>Special:</label>
        <input type="number" name="special" value="3" min="0" max="32"><br><br>
        
        <button type="submit">Generate Password</button>
    </form>

    <?php if ($generated_password): ?>
        <h4>Generated Password:</h4>
        <p style="font-weight: bold;"><?php echo $generated_password; ?></p>
    <?php endif; ?>

    <br>
    <a href="passwords.php">Manage Stored Passwords</a>
    <br><br>
    <a href="logout.php">Logout</a>
</body>
</html>
