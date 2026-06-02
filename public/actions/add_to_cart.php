<?php
session_start();

// establish connection to db
require_once(__DIR__ . "/../../includes/db.php");

// if user requests this file but is not logged in yet
if (!isset($_SESSION['user_id'])) {

    // send user to cart.php after successful login
    $_SESSION['redirect_after_login'] = '/cart.php';

    // redirect to login.php first
    header("Location: /login.php");
    exit;
}

$productId = $_GET['id'] ?? null;

if (!$productId) {
    die("Missing product id");
}

$userId = $_SESSION['user_id'];

// build query string to search db for cart from current user
$stmt = $pdo->prepare("
    SELECT * FROM carts
    WHERE user_id = ?
    AND checked_out = 0
");

// fill prepared statement and execute
$stmt->execute([$userId]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);


// create cart if none was found
if (!$cart) {

    // build query string
    $stmt = $pdo->prepare("
        INSERT INTO carts (user_id)
        VALUES (?)
    ");

    // fill prepared statement and execute
    $stmt->execute([$userId]);
    $cartId = $pdo->lastInsertId();
}

// user cart of currently logged-in user from db
else {
    $cartId = $cart['id'];
}

// check if product already exists in cart
$stmt = $pdo->prepare("
    SELECT * FROM cart_items
    WHERE cart_id = ?
    AND product_id = ?
");

// fill prepared statement and execute
$stmt->execute([$cartId, $productId]);
$cartItem = $stmt->fetch(PDO::FETCH_ASSOC);


// product already in cart; update quantity
if ($cartItem) {

    // build query string
    $stmt = $pdo->prepare("
        UPDATE cart_items
        SET quantity = quantity + 1
        WHERE id = ?
    ");

    // fill prepared statement and execute
    $stmt->execute([$cartItem['id']]);

}

// product not in cart yet; add
else {
    $stmt = $pdo->prepare("
        INSERT INTO cart_items (cart_id, product_id, quantity)
        VALUES (?, ?, 1)
    ");

    // fill prepared statement and execute
    $stmt->execute([$cartId, $productId]);
}

header("Location: /cart.php");
exit;