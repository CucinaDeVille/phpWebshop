<?php

// connect to db
require_once(__DIR__ . "/../includes/db.php");

// session parameter
$search = $_GET['search'] ?? '';

// empty array of found products
$products = [];

if ($search !== '') {

    // prepare query string
    $stmt = $pdo->prepare("
        SELECT *
        FROM products
        WHERE name LIKE ?
            OR description LIKE ?
    ");

    // place input between % to find anything containing this string
    $term = "%" . $search . "%";

    // fill prepared statement and execute
    $stmt->execute([$term, $term]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <!-- display search results -->
    <div class="container mt-5">

        <h1>Search results</h1>

        <!-- no input was provided -->
        <?php if ($search === ''): ?>
            <div class="alert alert-warning">
                Please enter a search term.
            </div>

        <!-- nothing was found -->
        <?php elseif (empty($products)): ?>
            <div class="alert alert-danger">
                No products found for "<?= htmlspecialchars($search) ?>"
            </div>

        <!-- something was found -->
        <?php else: ?>
            <p class="text-muted">
                Results for "<?= htmlspecialchars($search) ?>"
            </p>

            <!-- iterate through products array containing the results -->
            <?php foreach ($products as $product): ?>
                <div class="card mb-3">
                    <div class="card-body">

                        <h5><?= htmlspecialchars($product['name']) ?></h5>

                        <p><?= htmlspecialchars($product['description']) ?></p>

                        <strong><?= $product['price'] ?> €</strong>

                        <!-- display product picture -->
                        <img src="<?= htmlspecialchars($product['image']) ?>"
                             class="img-fluid mb-2"
                             style="max-height: 150px; object-fit: contain;"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                        >

                        <br><br>

                        <a class="btn btn-success mt-2"
                            href="actions/add_to_cart.php?id=<?= $product['id'] ?>">
                            Add to cart
                        </a>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

        <a href="index.php" class="btn btn-secondary mt-3">
            Back
        </a>

    </div>
</body>
</html>
