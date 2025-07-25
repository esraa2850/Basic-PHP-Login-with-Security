<?php
session_start();
require 'auth.php';

logout();
header("Location: login.php");
exit();
?>