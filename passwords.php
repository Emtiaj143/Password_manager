<?php include 'Views/header.php'; ?>
<?php
require_once __DIR__ . '/DB/database.php';
require_once __DIR__ . '/Classes/PasswordManager.php';

session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize database and manager
$db = (new Database())->getConnection();
$manager = new PasswordManager($db);

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = trim($_POST['service']);
    $password = trim($_POST['password']);

    if ($service !== '' && $password !== '') {
        $success = $manager->savePassword($service, $password);
        $message = $success ? "✅ Password saved successfully!" : "❌ Failed to save password.";
    } else {
        $message = "❗ All fields are required.";
    }
}

// Fetch stored passwords
$passwords = $manager->getPasswords();
?>

<?php include 'Views/header.php'; ?>

<h2>Store a New Password</h2>

<?php if (!empty($message)): ?>
    <p style="color: <?= strpos($message, '✅') !== false ? 'green' : 'red' ?>;">
        <?= $message ?>
    </p>
<?php endif; ?>

<form method="POST">
    <label>Service Name:</label><br>
    <input type="text" name="service" required><br><br>

    <label>Password:</label><br>
    <input type="text" name="password" required><br><br>

    <button type="submit">💾 Save Password</button>
</form>

<hr>

<h2>Your Saved Passwords</h2>
<?php if (count($passwords) === 0): ?>
    <p>No passwords saved yet.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Service</th>
            <th>Password</th>
            <th>Saved At</th>
        </tr>
        <?php foreach ($passwords as $entry): ?>
            <tr>
                <td><?= htmlspecialchars($entry['service']) ?></td>
                <td><?= htmlspecialchars($entry['decrypted_password']) ?></td>
                <td><?= $entry['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

<?php include 'Views/footer.php'; ?>
