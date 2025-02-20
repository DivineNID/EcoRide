<?php
session_start();
require 'db.php';

if (!isset($_SESSION['employe_id'])) {
    header('Location: login_form.html');
    exit();
}

// Récupérer les covoiturages ayant des problèmes
$stmt = $pdo->prepare("SELECT * FROM covoiturage WHERE probleme = 1");
$stmt->execute();
$covoiturages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Covoiturages Problématiques - EcoRide</title>
</head>
<body>
    <h1>Covoiturages Problématiques</h1>
    <table>
        <tr>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date</th>
            <th>Description du Problème</th>
        </tr>
        <?php foreach ($covoiturages as $covoiturage): ?>
            <tr>
                <td><?= htmlspecialchars($covoiturage['depart']) ?></td>
                <td><?= htmlspecialchars($covoiturage['arrivee']) ?></td>
                <td><?= htmlspecialchars($covoiturage['date_depart']) ?></td>
                <td><?= htmlspecialchars($covoiturage['description_probleme']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
