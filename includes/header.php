<?php
if (!isset($_SESSION)) {
    session_start();
}

// Option recommandée : base à la racine car public/ est la racine DocumentRoot
$base_path = '/';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : "EcoRide" ?></title>

    <!-- chemins absolus depuis la racine publique -->
    <link rel="stylesheet" href="<?= $base_path ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

<!-- NAVBAR DYNAMIQUE -->
<header class="navbar">
    <div class="nav-left">
        <a href="<?= $base_path ?>index.php">Accueil</a>
        <a href="<?= $base_path ?>covoiturage/liste_covoiturages.php">Covoiturages</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= $base_path ?>user/profil.php" class="user-link">
                👤 <?= htmlspecialchars($_SESSION['user_nom']) ?>
            </a>
            <a href="<?= $base_path ?>authentification/logout.php" style="color:#ef4444;">
                Déconnexion
            </a>
        <?php else: ?>
            <a href="<?= $base_path ?>authentification/login.php">Connexion</a>
            <a href="<?= $base_path ?>authentification/register.php">Inscription</a>
        <?php endif; ?>

        <a href="<?= $base_path ?>contact.php">Contact</a>
    </div>

    <div class="nav-search">
        <input type="text" placeholder="Rechercher un covoiturage...">
        <button><i class="fa fa-search"></i></button>
    </div>

    <div class="nav-logo">
        <span class="logo-text">EcoRide</span>
        <span class="logo-icon"><i class="fa fa-car-side"></i></span>
    </div>
</header>