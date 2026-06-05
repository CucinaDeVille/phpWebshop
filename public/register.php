<?php
session_start();

require_once("../includes/db.php");
?>

<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="UTF-8">

    <title>Register</title>

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
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="mb-4">
                        Set up an account
                    </h2>

                    <form action="/actions/register_action.php" method="POST">

                        <div class="mb-3">

                            <label for="username" class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label for="name" class="form-label">
                                Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="firstname"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label for="surname" class="form-label">
                                Surname
                            </label>

                            <input
                                type="text"
                                id="surname"
                                name="lastname"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label for="address" class="form-label">
                                Address
                            </label>

                            <textarea
                                name="address"
                                id="address"
                                class="form-control"
                                required></textarea>

                        </div>

                        <div class="mb-3">

                            <label for="mail" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                id="mail"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <button class="btn btn-primary w-100">

                            Sign up now!

                        </button>

                        <div class="mt-3 text-center">

                            <a href="login.php">
                                Already have an account? Log in!
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>