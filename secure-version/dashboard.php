<?php

require __DIR__ . '/security.php';
session_start();
safe_require('auth.php');

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <p>Your email: <?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>