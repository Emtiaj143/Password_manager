<?php
require_once __DIR__ . '/Classes/User.php';

session_start();

$user = new User(null);
$user->logout();

header("Location: login.php");
exit();
?>
