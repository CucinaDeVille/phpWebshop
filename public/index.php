<?php
session_start();
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
            <!-- differentiate between logged in and logged out -->
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

    <h1>Welcome to my webshop</h1>

    <p>
        Here you can find and buy products!
    </p>

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
