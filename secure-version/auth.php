<?php
require_once __DIR__ . '/security.php';
safe_require('db.php');

function secureSessionStart() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_samesite', 'Strict');
    session_start();
    
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id(true);
        $_SESSION['initiated'] = true;
        $_SESSION['last_activity'] = time();
    }
    
    // session timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        die();
    }
    $_SESSION['last_activity'] = time();
}

function registerUser($username, $email, $password) {
    $pdo = getDbConnection(); // Get connection from db.php
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hash]);
    return true;
}

function loginUser($username, $password) {
    $pdo = getDbConnection(); // Get connection from db.php
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
            $update->execute([$newHash, $user['id']]);
        }
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function logout() {
    unset($_SESSION['user']);
}
?>