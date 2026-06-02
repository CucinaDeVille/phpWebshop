<?php
session_start();

require_once(__DIR__ . "/../../includes/db.php");

$username = $_POST['username'];
$password = $_POST['password'];

// build query string
$stmt = $pdo->prepare("
    SELECT * FROM users
    WHERE username = ?
");

// fill prepared statement and execute
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    // set redirect variable either to .index or .cart if user requested that initially
    $redirect = $_SESSION['redirect_after_login'] ?? '/index.php';

    // delete session variable
    unset($_SESSION['redirect_after_login']);

    // redirect to given variable
    header("Location: $redirect");
    exit;

} else {

    echo "
    <script>
        alert('Invalid username or password');
        window.location.href='/login.php';
    </script>
    ";
}