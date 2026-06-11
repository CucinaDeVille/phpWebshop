<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

$parentId = $_GET['parent_id'] ?? null;

if ($parentId === null) {
    // show root categories
    $stmt = $pdo->query("SELECT * FROM categories WHERE parent_id IS NULL");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $mode = "categories";
} else {
    // check for subcategories
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE parent_id = ?");
    $stmt->execute([$parentId]);
    $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($subcategories) > 0) {
        $mode = "categories";
        $items = $subcategories;
    } else {
        $mode = "products";

        $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ?");
        $stmt->execute([$parentId]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($products) > 0) {
            $mode = "products";
            $items = $products;
        } else {
            // fallback (important!)
            $mode = "products";
            $items = [];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
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

    <?php if ($mode === "categories"): ?>

        <h2 class="mb-4">Categories</h2>
        <div class="row g-3">
            <?php foreach ($items as $item): ?>
                <div class="col-12">
                    <a href="categories.php?parent_id=<?= $item['id'] ?>"
                        class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-0">
                                    <?= htmlspecialchars($item['name']) ?>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>

        <h2>Products</h2>

        <div class="row">

            <!-- iterate through all items of category -->
            <?php foreach ($items as $product): ?>
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">

                                <!-- display product picture -->
                                <div class="col-md-2 text-center">
                                    <img src="<?= htmlspecialchars($product['image']) ?>"
                                         class="img-fluid"
                                         style="max-height: 150px; object-fit: contain;"
                                         alt="<?= htmlspecialchars($product['name']) ?>"
                                    >
                                </div>

                                <!-- display name and description -->
                                <div class="col-md-7">
                                    <h5><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="mb-0">
                                        <?= htmlspecialchars($product['description']) ?>
                                    </p>
                                </div>

                                <div class="col-md-3 text-end">
                                    <!-- display product price -->
                                    <h3 class="text-danger mb-3">
                                        <?= $product['price'] ?> €
                                    </h3>

                                    <!-- button to add to cart -->
                                    <a class="btn btn-success mt-2"
                                        href="actions/add_to_cart.php?id=<?= $product['id'] ?>">
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>