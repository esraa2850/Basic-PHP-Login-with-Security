<?php
session_start();
require 'auth.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<h1>Welcome, <?= $user['username'] ?></h1>
<p>Your email: <?= $user['email'] ?></p>
<a href="logout.php">Logout</a>