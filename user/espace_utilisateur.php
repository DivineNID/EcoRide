<?php
session_start();
require 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login_form.html');
    exit();
}

$utilisateur_id = $_SESSION['utilisateur_id'];

// Récupérer les informations de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id = :id");
$stmt->execute([':id' => $utilisateur_id]);
$utilisateur = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Utilisateur - EcoRide</title>
</head>
<body>
    <h1>Bienvenue, <?= htmlspecialchars($utilisateur['pseudo']) ?> !</h1>

    <h2>Vos Informations</h2>
    <form action="modifier_profil.php" method="POST">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($utilisateur['pseudo']) ?>" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required><br>

        <button type="submit">Modifier</button>
    </form>

    <h2>Votre Crédit : <?= $utilisateur['credits'] ?> crédits</h2>

    <a href="ajouter_vehicule.php">Ajouter un véhicule</a><br>
    <a href="historique_trajets.php">Consulter l'historique de vos trajets</a><br>
    <a href="logout.php">Déconnexion</a>
</body>
</html>
