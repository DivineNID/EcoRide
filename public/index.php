<?php
// Inclure le fichier de configuration de la base de données
include_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Covoiturage Écologique</title>
    
    <!-- Inclure les fichiers CSS -->
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/responsive.css">

    <!-- Inclure les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <h1>EcoRide</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="covoiturages.php">Covoiturages</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="login.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <!-- Section principale -->
    <section class="hero">
        <h2>Voyagez plus vert avec EcoRide</h2>
        <p>Trouvez ou proposez un trajet en quelques clics.</p>
        <a href="covoiturages.php" class="btn">Rechercher un covoiturage</a>
    </section>

    <!-- Pied de page -->
    <footer>
        <p>&copy; 2025 EcoRide - Tous droits réservés.</p>
    </footer>

    <!-- Fichier JavaScript -->
    <script src="assets/js/script.js"></script>
</body>
</html>

