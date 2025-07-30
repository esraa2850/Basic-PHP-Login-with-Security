<?php
require __DIR__ . '/security.php';
session_start();
safe_require('auth.php');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (registerUser($username, $email, $password)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php if (!empty($error)) echo "<p>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Login</a>
</body>
</html>