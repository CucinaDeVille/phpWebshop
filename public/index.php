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
            <a href="login.php" class="btn btn-outline-light">
                Login
            </a>

            <a href="register.php" class="btn btn-warning">
                Registrieren
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <h1>Willkommen im Webshop</h1>

    <p>
        Hier können Produkte durchsucht und gekauft werden.
    </p>

    <form action="search.php" method="GET" class="mt-4">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Produkte suchen...">

            <button class="btn btn-primary">
                Suchen
            </button>

        </div>

    </form>

</div>

</body>
</html>
