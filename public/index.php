<?php
session_start();

require_once __DIR__ . '/../includes/db.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Webshop</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        .carousel-inner img {
            max-height: 400px;
            width: auto;
            object-fit: contain;
            margin: 0 auto;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

    <h1>Welcome to my page, <?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?> </h1>

    <p>
        Highlights of the week!
    </p>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/router.jpeg" class="d-block w-100" alt="router">
            </div>
            <div class="carousel-item">
                <img src="assets/images/mouse.jpeg" class="d-block w-100" alt="mouse">
            </div>
            <div class="carousel-item">
                <img src="assets/images/hairdryer.jpeg" class="d-block w-100" alt="hairdryer">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <form action="search.php" method="GET" class="mt-4">

        <div class="input-group">

            <label for="find" class="visually-hidden">
                Suche
            </label>

            <input
                type="text"
                id="find"
                name="search"
                class="form-control"
                placeholder="Browse products...">

            <button type="submit" class="btn btn-primary">
                Find
            </button>
        </div>
    </form>

    <!-- show all products in store -->
    <h2 class="mt-5 mb-4">All Products</h2>

    <div class="row">

        <?php foreach ($products as $product): ?>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">

                            <!-- image -->
                            <div class="col-md-2 text-center">
                                <img src="<?= htmlspecialchars($product['image']) ?>"
                                     class="img-fluid"
                                     style="max-height: 150px; object-fit: contain;"
                                     alt="<?= htmlspecialchars($product['name']) ?>">
                            </div>

                            <!-- name + description -->
                            <div class="col-md-7">
                                <h5><?= htmlspecialchars($product['name']) ?></h5>
                                <p class="mb-0">
                                    <?= htmlspecialchars($product['description']) ?>
                                </p>
                            </div>

                            <!-- price + button -->
                            <div class="col-md-3 text-end">
                                <h3 class="text-danger mb-3">
                                    <?= $product['price'] ?> €
                                </h3>

                                <a class="btn btn-success"
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

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
