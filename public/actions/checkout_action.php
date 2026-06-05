<?php

session_start();

// establish connection to db
require_once(__DIR__ . "/../../includes/db.php");

// if user requests this file but is not logged in yet
if (!isset($_SESSION['user_id'])) {

    // redirect to login.php first
    header("Location: /login.php");
    exit;
}

// active cart
$stmt = $pdo->prepare("
    SELECT *
    FROM carts
    WHERE user_id = ?
      AND checked_out = 0
");

// fill prepared statement and execute
$stmt->execute([$_SESSION['user_id']]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

// there's no cart found for signed-in user
if (!$cart) {
    header("Location: /cart.php"); // redirect back to shopping cart
    exit;
}

// implicit else: a cart was found
$stmt = $pdo->prepare("
    SELECT
        ci.product_id,
        ci.quantity,
        p.name,
        p.price
    FROM cart_items ci
    JOIN products p
        ON ci.product_id = p.id
    WHERE ci.cart_id = ?
");

// fill prepared statement and execute
$stmt->execute([$cart['id']]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// there are no items in said cart
if (empty($items)) {
    header("Location: /cart.php"); // redirect back to shopping cart
    exit;
}

// implicit else: a cart was found and it is not empty: calculate total
$total = 0;

// iterate through all items in cart
foreach ($items as $item) {
    $total += $item['price'] * $item['quantity'];
}

// create order with items in cart and calculated price in orders table
$stmt = $pdo->prepare("
    INSERT INTO orders (user_id, total, payment_method)
    VALUES (?, ?, ?)
    ");

// fill prepared statement and execute
$stmt->execute([
    $_SESSION['user_id'],
    $total,
    'PayPal'
]);

$orderId = $pdo->lastInsertId();

// insert all products in this order into order_items table
$stmt = $pdo->prepare("
    INSERT INTO order_items (order_id, product_id, product_name, price, quantity)
    VALUES(?, ?, ?, ?, ?)
    ");

// iterate through all items of order, fill prepared statement for each one, and execute it subsequently
foreach ($items as $item) {
    $stmt->execute([
        $orderId,
        $item['product_id'],
        $item['name'],
        $item['price'],
        $item['quantity']
    ]);
}

// close cart
$stmt = $pdo->prepare("
    UPDATE carts
    SET checked_out = 1
    WHERE id = ?
");

// fill and execute prepared statement
$stmt->execute([$cart['id']]);

// redirect to success page
header("Location: /actions/paypal_success.php?order_id=" . $orderId);
exit;