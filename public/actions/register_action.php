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

$stmt = $pdo->prepare("
    INSERT INTO users
    (username, password, firstname, lastname, address, email)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $username,
    $hashedPassword,
    $firstname,
    $lastname,
    $address,
    $email
]);

header("Location: /login.php");
exit;