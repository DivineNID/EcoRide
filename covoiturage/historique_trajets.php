<?php
session_start();
require 'db.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login_form.html');
    exit();
}

$utilisateur_id = $_SESSION['utilisateur_id'];

$stmt = $pdo->prepare("SELECT * FROM covoiturage WHERE chauffeur_id = :id OR passager_id = :id");
$stmt->execute([':id' => $utilisateur_id]);
$trajets = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Trajets - EcoRide</title>
</head>
<body>
    <h1>Historique des Trajets</h1>
    <ul>
        <?php foreach ($trajets as $trajet): ?>
            <li><?= $trajet['depart'] ?> → <?= $trajet['arrivee'] ?> (<?= $trajet['date_depart'] ?>)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
