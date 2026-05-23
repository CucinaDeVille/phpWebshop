<?php
session_start();

require_once(__DIR__ . "/../../includes/db.php");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("
    SELECT * FROM users
    WHERE username = ?
");

$stmt->execute([$username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    echo "
    <script>
        alert('Login successful');
        window.location.href='/index.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Invalid username or password');
        window.location.href='/login.php';
    </script>
    ";
}