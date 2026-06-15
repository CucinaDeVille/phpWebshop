<?php

$host = "db";
$dbname = "webshop";
$user = "webshop";
$pass = "webshop";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    die("DB error: " . $e->getMessage());

}