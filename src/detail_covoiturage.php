<?php
// detail_covoiturage.php

// Inclusion de la connexion à la base de données et démarrage de la session
include 'db.php';
session_start();

// Vérification que l'ID du covoiturage est passé en paramètre dans l'URL
if (!isset($_GET['id'])) {
    echo "Covoiturage non spécifié.";
    exit;
}

// Récupération de l'ID du covoiturage depuis l'URL
$covoiturage_id = (int) $_GET['id'];

// Préparation de la requête pour récupérer les détails du covoiturage
$query = $pdo->prepare("
    SELECT c.*, u.pseudo, u.photo, u.note, v.marque, v.modele, v.energie
    FROM covoiturages c
    JOIN utilisateurs u ON c.chauffeur_id = u.id
    JOIN vehicules v ON c.vehicule_id = v.id
    WHERE c.id = :id
");
$query->execute(['id' => $covoiturage_id]);
$covoiturage = $query->fetch();

// Si aucun covoiturage n'a été trouvé
if (!$covoiturage) {
    echo "Covoiturage introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Covoiturage</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Détails du Covoiturage</h1>

    <div class="covoiturage-details">
        <h2>Trajet : <?= htmlspecialchars($covoiturage['depart']) ?> ➔ <?= htmlspecialchars($covoiturage['arrivee']) ?></h2>
        <p><strong>Chauffeur :</strong> <?= htmlspecialchars($covoiturage['pseudo']) ?></p>
        <img src="images/<?= htmlspecialchars($covoiturage['photo']) ?>" alt="Photo du chauffeur" width="100">
        <p><strong>Note :</strong> <?= htmlspecialchars($covoiturage['note']) ?>/5</p>

        <p><strong>Date et heure de départ :</strong> <?= htmlspecialchars($covoiturage['date_depart']) ?> à <?= htmlspecialchars($covoiturage['heure_depart']) ?></p>
        <p><strong>Date et heure d'arrivée :</strong> <?= htmlspecialchars($covoiturage['date_arrivee']) ?> à <?= htmlspecialchars($covoiturage['heure_arrivee']) ?></p>

        <p><strong>Places disponibles :</strong> <?= htmlspecialchars($covoiturage['places_restantes']) ?></p>
        <p><strong>Prix :</strong> <?= htmlspecialchars($covoiturage['prix']) ?> €</p>

        <p><strong>Véhicule :</strong> <?= htmlspecialchars($covoiturage['marque']) ?> <?= htmlspecialchars($covoiturage['modele']) ?> (<?= htmlspecialchars($covoiturage['energie']) ?>)</p>

        <p><strong>Voyage écologique :</strong> <?= $covoiturage['energie'] === 'électrique' ? 'Oui' : 'Non' ?></p>

        <h3>Avis des utilisateurs :</h3>
        <ul>
            <?php
            // Requête pour récupérer les avis du chauffeur
            $avis_query = $pdo->prepare("SELECT auteur, commentaire, note FROM avis WHERE chauffeur_id = :chauffeur_id");
            $avis_query->execute(['chauffeur_id' => $covoiturage['chauffeur_id']]);
            $avis = $avis_query->fetchAll();

            if ($avis) {
                foreach ($avis as $a) {
                    echo "<li><strong>{$a['auteur']} :</strong> {$a['commentaire']} ({$a['note']}/5)</li>";
                }
            } else {
                echo "<li>Aucun avis pour ce chauffeur.</li>";
            }
            ?>
        </ul>

        <?php if ($covoiturage['places_restantes'] > 0): ?>
            <form action="participer_covoiturage.php" method="POST">
                <input type="hidden" name="covoiturage_id" value="<?= $covoiturage_id ?>">
                <button type="submit">Participer à ce covoiturage</button>
            </form>
        <?php else: ?>
            <p><strong>Ce covoiturage est complet.</strong></p>
        <?php endif; ?>
    </div>

    <a href="liste_covoiturages.php">Retour à la liste des covoiturages</a>
</body>
</html>
