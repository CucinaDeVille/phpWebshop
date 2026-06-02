<?php
session_start();

// connect to db
require_once(__DIR__ . "/../../includes/db.php");

// require login if user not logged in yet
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

$cartItemId = $_GET['id'] ?? null;

if (!$cartItemId) {
    header("Location: /cart.php");
    exit;
}

// remove item from db
$stmt = $pdo->prepare("
    DELETE FROM cart_items
    WHERE id = ?
");

// fill prepared statement and execure
$stmt->execute([$cartItemId]);

header("Location: /cart.php");
exit;