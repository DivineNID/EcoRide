<?php
session_start();
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login_form.html');  // Rediriger si non connecté
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - EcoRide</title>
</head>
<body>
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['pseudo']); ?> !</h1>
    <p>Vous êtes connecté en tant que <?php echo htmlspecialchars($_SESSION['role']); ?>.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
