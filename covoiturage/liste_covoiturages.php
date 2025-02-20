<?php
require 'db.php';

try {
    $stmt = $pdo->query("SELECT c.*, u.pseudo FROM covoiturage c JOIN utilisateur u ON c.utilisateur_id = u.id WHERE c.places > 0");
    $covoiturages = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Covoiturages - EcoRide</title>
</head>
<body>
    <h1>Liste des Covoiturages</h1>
    <?php if ($covoiturages): ?>
        <ul>
            <?php foreach ($covoiturages as $covoiturage): ?>
                <li>
                    <strong>Départ :</strong> <?= htmlspecialchars($covoiturage['depart']) ?> - 
                    <strong>Arrivée :</strong> <?= htmlspecialchars($covoiturage['arrivee']) ?><br>
                    <strong>Conducteur :</strong> <?= htmlspecialchars($covoiturage['pseudo']) ?><br>
                    <strong>Prix :</strong> <?= htmlspecialchars($covoiturage['prix']) ?> €<br>
                    <strong>Places restantes :</strong> <?= htmlspecialchars($covoiturage['places']) ?><br>
                    <a href="detail_covoiturage.php?id=<?= $covoiturage['id'] ?>">Détails</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun covoiturage disponible pour le moment.</p>
    <?php endif; ?>
</body>
</html>
