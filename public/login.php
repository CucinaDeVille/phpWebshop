<?php
session_start();

require_once(__DIR__ . "/../includes/db.php");

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username = ?"
    );

    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['last_activity'] = time();

        echo "
            <script>
                alert('Login successful');
                window.location.href='index.php';
            </script>
        ";

        header("Location: index.php");

        exit;

    } else {

        $error = "Username or password incorrect";

    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">

    <title>Login</title>

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

            <a href="register.php" class="btn btn-warning">
                Sign up
            </a>

        </div>

    </div>

</nav>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="mb-4">
                        Login
                    </h2>

                    <?php if (!empty($error)): ?>

                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label for="username" class="form-label">
                                User name
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

                        <button class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                    <div class="mt-3 text-center">

                        <a href="register.php">
                            Don't have an account yet? Sign up!
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
