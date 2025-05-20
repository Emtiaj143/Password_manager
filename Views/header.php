<!DOCTYPE html>
<html>
<head>
    <title>Password Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f5f5f5;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        input, button {
            padding: 8px;
            margin: 5px 0;
        }
        button {
            background-color: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: white;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

<nav>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="passwords.php">Stored Passwords</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>
</nav>
<hr>
