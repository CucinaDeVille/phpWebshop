<?php
session_start();
require_once(__DIR__ . "/../../includes/db.php");

if (!isset($_SESSION['user_id'])) {
    die("Not logged in");
}

// PayPal sends cart id
$cartId = isset($_GET['item_number']) ? (int)$_GET['item_number'] : null;

// transaction id (PayPal uses tx)
$transactionId = $_GET['tx'] ?? $_GET['txn_id'] ?? null;

// safety check
if (!$cartId || !$transactionId) {
    die("Invalid PayPal request");
}

// load cart and items
$stmt = $pdo->prepare("
    SELECT * FROM carts WHERE id = ? AND user_id = ?
");
$stmt->execute([$cartId, $_SESSION['user_id']]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cart) {
    die("Cart not found");
}

$stmt = $pdo->prepare("
    SELECT
        ci.product_id,
        ci.quantity,
        p.name,
        p.price
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    WHERE ci.cart_id = ?
");
$stmt->execute([$cartId]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$items) {
    die("Cart empty");
}

// save order to db
$total = 0;
foreach ($items as $item) {
    $total += $item['price'] * $item['quantity'];
}

$stmt = $pdo->prepare("
    INSERT INTO orders (user_id, total, payment_method, paypal_transaction_id)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([
        $_SESSION['user_id'],
        $total,
        'PayPal',
        $transactionId
]);

$orderId = $pdo->lastInsertId();
$order = [
        'id' => $orderId,
        'total' => $total
];

// save order items to db
$stmt = $pdo->prepare("
    INSERT INTO order_items (order_id, product_id, product_name, price, quantity)
    VALUES (?, ?, ?, ?, ?)
");

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
$stmt->execute([$cartId]);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellung erfolgreich</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            Mein Webshop
        </a>
        <div>
            <a href="categories.php" class="btn btn-primary">
                Categories
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="cart.php" class="btn btn-success">
                    Shopping cart
                </a>

                <a href="logout.php" class="btn btn-danger">
                    Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light">
                    Login
                </a>

                <a href="register.php" class="btn btn-warning">
                    Register
                </a>
            <?php endif; ?>
        </div>

    </div>
</nav>

<div class="container mt-5">

    <div class="alert alert-success">
        <h2>Bestellung erfolgreich abgeschlossen</h2>
        <p>Vielen Dank für deinen Einkauf!</p>
    </div>

    <h4>Bestellnummer: #<?= htmlspecialchars($order['id']) ?></h4>
    <p><strong>Gesamt:</strong> <?= htmlspecialchars($order['total']) ?> €</p>

    <h5 class="mt-4">Produkte</h5>

    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">

                        <h6><?= htmlspecialchars($item['name']) ?></h6>
                        <p><?= $item['price'] ?> € × <?= $item['quantity'] ?></p>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="/index.php" class="btn btn-primary mt-3">
        Zurück zum Shop
    </a>

</div>

</body>
</html>