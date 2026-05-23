<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$id = $_GET['id'] ?? null;
$name = $_GET['name'] ?? null;
$price = $_GET['price'] ?? null;

if (!$id || !$name || !$price) {
    die("Missing product data");
}

$_SESSION['cart'][] = [
    "id" => $id,
    "name" => $name,
    "price" => $price
];

header("Location: /cart.php");
exit;