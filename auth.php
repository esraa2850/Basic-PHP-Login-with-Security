<?php
require 'db.php';

// Register a new user (INSECURE)
function registerUser($username, $email, $password) {
    global $pdo;
    
    // Basic check if user exists
    $check = $pdo->query("SELECT id FROM users WHERE username='$username' OR email='$email'");
    if ($check->rowCount() > 0) {
        return false;
    }
    
    // Weak password hashing (for demonstration only)
    $hash = md5($password);
    
    // Insecure query
    $pdo->exec("INSERT INTO users (username, email, password_hash) 
               VALUES ('$username', '$email', '$hash')");
    return true;
}

// Login user (INSECURE)
function loginUser($username, $password) {
    global $pdo;
    
    // Insecure query
    $user = $pdo->query("SELECT * FROM users WHERE username='$username'")->fetch();
    
    // Weak password verification
    if ($user && md5($password) === $user['password_hash']) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

// Check if logged in
function isLoggedIn() {
    return isset($_SESSION['user']);
}

// Logout
function logout() {
    unset($_SESSION['user']);
}
?>