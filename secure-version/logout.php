<?php
require __DIR__ . '/security.php';
session_start();
safe_require('auth.php');

logout();
header("Location: login.php");
exit();
?>