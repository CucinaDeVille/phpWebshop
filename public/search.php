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

        <?php endif; ?>

        <a href="index.php" class="btn btn-secondary mt-3">
            Back
        </a>

    </div>
</body>
</html>
