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
<body class="container mt-4">

<h1>Shop</h1>

<?php if ($mode === "categories"): ?>

    <h2>Categories</h2>

    <ul class="list-group">
        <?php foreach ($items as $item): ?>
            <li class="list-group-item">
                <a href="categories.php?parent_id=<?= $item['id'] ?>">
                    <?= htmlspecialchars($item['name']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>

    <h2>Products</h2>

    <div class="row">

        <!-- iterate through all items of category -->
        <?php foreach ($items as $product): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">

                        <!-- display product name -->
                        <h5><?= htmlspecialchars($product['name']) ?></h5>

                        <!-- display product picture -->
                        <img src="<?= htmlspecialchars($product['image']) ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($product['name']) ?>"
                        >

                        <!-- display product description -->
                        <p><?= htmlspecialchars($product['description']) ?></p>

                        <!-- display product price -->
                        <strong><?= $product['price'] ?> €</strong>

                        <!-- button to add to cart -->
                        <a class="btn btn-success mt-2"
                           href="actions/add_to_cart.php?id=<?= $product['id'] ?>&name=<?= urlencode($product['name']) ?>&price=<?= $product['price'] ?>">
                            Add to cart
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

<?php endif; ?>

</body>
</html>