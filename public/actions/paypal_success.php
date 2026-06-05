<?php
session_start();
require_once(__DIR__ . "/../../includes/db.php");

$orderId = $_GET['order_id'] ?? null;

if (!$orderId) {
    die("Invalid order");
}

$stmt = $pdo->prepare("
    SELECT * FROM orders WHERE id = ?
");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
    SELECT oi.*, p.image
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
");
$stmt->execute([$orderId]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellung erfolgreich</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="alert alert-success">
        <h2>Bestellung erfolgreich abgeschlossen</h2>
        <p>Vielen Dank für deinen Einkauf!</p>
    </div>

    <h4>Bestellnummer: #<?= htmlspecialchars($order['id']) ?></h4>
    <p><strong>Gesamt:</strong> <?= htmlspecialchars($order['total']) ?> €</p>

    <h5 class="mt-4">Produkte</h5>

    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">

                        <h6><?= htmlspecialchars($item['product_name']) ?></h6>
                        <p><?= $item['price'] ?> € × <?= $item['quantity'] ?></p>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="/index.php" class="btn btn-primary mt-3">
        Zurück zum Shop
    </a>

</div>

</body>
</html>