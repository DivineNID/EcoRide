<?php
session_start();
require 'db.php';

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Administrateur - EcoRide</title>
</head>
<body>
    <h1>Espace Administrateur</h1>
    <h2>Options</h2>
    <ul>
        <li><a href="gerer_employes.php">Gérer les Comptes Employés</a></li>
        <li><a href="statistiques.php">Visualiser Statistiques</a></li>
    </ul>
</body>
</html>
