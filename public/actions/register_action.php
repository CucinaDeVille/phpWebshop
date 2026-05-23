<?php
session_start();

require_once(__DIR__ . "/../../includes/db.php");

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$email = $_POST['email'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);

$existingUser = $stmt->fetch();

if ($existingUser) {
    echo "
    <script>
        alert('Username already taken');
        window.location.href = '/register.php';
    </script>
    ";
    exit;
}

$stmt = $pdo->prepare("
    INSERT INTO users
    (username, password, firstname, lastname, address, email)
    VALUES (?, ?, ?, ?, ?, ?)
");

try {
    $stmt->execute([
        $username,
        $hashedPassword,
        $firstname,
        $lastname,
        $address,
        $email
    ]);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "<script>alert('An unexpected error occurred'); window.location.href='/register.php';</script>";
        exit;
    }
}

header("Location: /login.php");
exit;