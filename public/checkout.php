<?php
session_start();

// connect to db
require_once(__DIR__ . "/../includes/db.php");

// paypal connection
require_once(__DIR__ . "/../includes/paypal_config.php");

// user not logged in yet
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

// Get cart of user
$stmt = $pdo->prepare("
    SELECT *
    FROM carts
    WHERE user_id = ?
      AND checked_out = 0
");

// fill prepared statement and execute
$stmt->execute([$_SESSION['user_id']]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

$items = []; // array holds all items in shopping cart
$total = 0; // store grand total

// if a cart exists for this user
if ($cart) {

    // get product information for all items in cart based on their ids
    $stmt = $pdo->prepare("
        SELECT
            ci.id,
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

    // aggregate total price
    foreach ($items as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
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

    <h1>Checkout</h1>

    <!-- shopping cart empty -->
    <?php if (empty($items)): ?>

        <div class="alert alert-warning">
            Your shopping cart is empty.
        </div>

    <!-- shopping cart not empty -->
    <?php else: ?>

        <ul class="list-group mb-3">

            <!-- iterate through array with all items -->
            <?php foreach ($items as $item): ?>

                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <?= htmlspecialchars($item['name']) ?>
                        <br>
                        <small>
                            Quantity: <?= $item['quantity'] ?>
                        </small>
                    </div>
                    <strong>
                        <?= number_format($item['price'] * $item['quantity'], 2) ?> €
                    </strong>
                </li>

            <?php endforeach; ?>

        </ul>

        <!-- total price -->
        <div class="card mb-3">
            <div class="card-body">
                <h4>
                    Total:
                    <?= number_format($total, 2) ?> €
                </h4>
            </div>
        </div>

        <!-- connection to check out with PayPal -->
        <form action="<?= PAYPAL_URL ?>" method="post">

            <input type="hidden"
                   name="business"
                   value="<?= PAYPAL_ID ?>">

            <input type="hidden"
                   name="cmd"
                   value="_xclick">

            <input type="hidden"
                   name="item_name"
                   value="Shopping Cart">

            <input type="hidden"
                   name="item_number"
                   value="<?= $cart['id'] ?>">

            <input type="hidden"
                   name="amount"
                   value="<?= $total ?>">

            <input type="hidden"
                   name="currency_code"
                   value="<?= PAYPAL_CURRENCY ?>">

            <input type="hidden"
                   name="return"
                   value="<?= PAYPAL_RETURN_URL ?>">

            <input type="hidden"
                   name="cancel_return"
                   value="<?= PAYPAL_CANCEL_URL ?>">

            <button type="submit"
                    class="btn btn-success">
                Pay with PayPal
            </button>

        </form>

    <?php endif; ?>

    <a href="cart.php" class="btn btn-secondary mt-3">
        Back to cart
    </a>

</div>

</body>
</html>