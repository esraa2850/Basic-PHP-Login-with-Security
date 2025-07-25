<?php
session_start();
require 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (loginUser($username, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Login failed";
    }
}
?>

<h1>Login</h1>
<?php if (isset($error)) echo "<p>$error</p>"; ?>
<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<a href="register.php">Register</a>