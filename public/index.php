<?php
session_start();

require_once(__DIR__ . "/../includes/db.php");

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Webshop</title>

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

                <a href="cart.php" class="btn btn-success">
                    Shopping cart
                </a>

                <a href="logout.php" class="btn btn-danger">
                    Logout
                </a>

                <a href="login.php" class="btn btn-outline-light">
                    Login
                </a>

                <a href="register.php" class="btn btn-warning">
                    Register
                </a>
        </div>

    </div>
</nav>

<div class="container mt-5">

    <h1>Welcome to my webshop</h1>

    <p>
        Here you can find and buy products!
    </p>

    <a href="actions/add_to_cart.php?id=1&name=Testprodukt&price=9.99"
       class="btn btn-success">
        Add to cart
    </a>

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

</div>

</body>
</html>
