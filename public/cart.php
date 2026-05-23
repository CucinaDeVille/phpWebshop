<?php
session_start();

// user not logged in yet
if (!isset($_SESSION['user_id'])) {

    // remember user requested /cart.php
    $_SESSION['redirect_after_login'] = '/cart.php';

    // redirect to login.php
    header("Location: /login.php");
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
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

    <?php if (empty($_SESSION['cart'])): ?>

        <p>The shopping cart is empty.</p>

    <?php else: ?>

        <ul class="list-group">

            <?php foreach ($_SESSION['cart'] as $index => $product): ?>

                <li class="list-group-item d-flex justify-content-between">

                    <span>
                        <?= htmlspecialchars($product['name']) ?> - <?= $product['price'] ?> €
                    </span>

                    <a href="/actions/remove_from_cart.php?index=<?= $index ?>" class="btn btn-sm btn-danger">
                        Remove
                    </a>

                </li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

    <a href="index.php" class="btn btn-primary mt-3">
        Go back
    </a>

</div>

</body>
</html>