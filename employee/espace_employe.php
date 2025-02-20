<?php
session_start();
require 'db.php';

// Vérifier si l'utilisateur est connecté et est un employé
if (!isset($_SESSION['employe_id'])) {
    header('Location: login_form.html');
    exit();
}

// Récupérer les avis non validés
$stmt = $pdo->prepare("SELECT * FROM avis WHERE valide = 0");
$stmt->execute();
$avis = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Employé - EcoRide</title>
</head>
<body>
    <h1>Espace Employé</h1>
    
    <h2>Avis à Valider</h2>
    <table>
        <tr>
            <th>Pseudo Utilisateur</th>
            <th>Avis</th>
            <th>Action</th>
        </tr>
        <?php foreach ($avis as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a['pseudo_utilisateur']) ?></td>
                <td><?= htmlspecialchars($a['contenu']) ?></td>
                <td>
                    <form action="valider_avis.php" method="POST">
                        <input type="hidden" name="avis_id" value="<?= $a['id'] ?>">
                        <button type="submit">Valider</button>
                    </form>
                    <form action="refuser_avis.php" method="POST">
                        <input type="hidden" name="avis_id" value="<?= $a['id'] ?>">
                        <button type="submit">Refuser</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Covoiturages Problématiques</h2>
    <a href="covoiturages_problemes.php">Voir les covoiturages ayant des problèmes</a>
</body>
</html>
