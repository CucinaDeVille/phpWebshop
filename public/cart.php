<?php
session_start();

// connect to db
require_once(__DIR__ . "/../includes/db.php");

// user not logged in yet
if (!isset($_SESSION['user_id'])) {

    // remember user requested /cart.php
    $_SESSION['redirect_after_login'] = '/cart.php';

    // redirect to login.php
    header("Location: /login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// get active cart
$stmt = $pdo->prepare("
    SELECT * FROM carts
    WHERE user_id = ?
    AND checked_out = 0
");

// fill prepared statement and execute
$stmt->execute([$userId]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

// empty if no cart yet
$items = [];

if ($cart) {
    $stmt = $pdo->prepare("
        SELECT ci.id AS cart_item_id,
               ci.quantity,
               p.name,
               p.price
        FROM cart_items ci
        JOIN products p ON ci.product_id = p.id
        WHERE ci.cart_id = ?
    ");

    // fill prepared statement and execute
    $stmt->execute([$cart['id']]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Shopping cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1>Shopping cart</h1>

    <?php if (empty($items)): ?>

        <p>The shopping cart is empty.</p>

    <?php else: ?>

        <ul class="list-group">

            <?php foreach ($items as $item): ?>

                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <strong>
                            <?= htmlspecialchars($item['name']) ?> - <?= $item['price'] ?> €
                        </strong>

                        <div class="text-muted">
                            <?= number_format($item['price'], 2) ?> € × <?= $item['quantity'] ?>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">

                        <!-- total price -->
                        <span class="badge bg-primary rounded-pill">
                            <?= number_format($item['price'] * $item['quantity'], 2) ?> €
                        </span>

                        <a href="/actions/remove_from_cart.php?id=<?= $item['cart_item_id'] ?>" class="btn btn-sm btn-danger">
                            Remove
                        </a>
                    </div>
                </li>

            <?php endforeach; ?>

        </ul>

        <div class="text-end">
            <a href="checkout.php" class="btn btn-success">
                Checkout
            </a>
        </div>

    <?php endif; ?>

    <a href="index.php" class="btn btn-primary mt-3">
        Go back
    </a>

</div>

</body>
</html>