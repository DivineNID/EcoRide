<?php
session_start();
require_once 'config/database.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Accueil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <header>
        <nav>
            <a href="home.php" class="logo">EcoRide</a>
            <ul>
                <li><a href="liste_covoiturages.php">Trouver un trajet</a></li>
                <li><a href="saisie_covoiturage.php">Proposer un trajet</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="espace_utilisateur.php">Mon espace</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="register.php">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Économisez et voyagez autrement avec EcoRide</h1>
        <p>Rejoignez une communauté de covoitureurs engagés pour une mobilité plus verte.</p>
        <a href="register.php" class="btn">S'inscrire</a>
    </section>

    <!-- Formulaire de recherche de covoiturage -->
    <section class="search">
        <h2>Rechercher un covoiturage</h2>
        <form action="liste_covoiturages.php" method="GET">
            <input type="text" name="depart" placeholder="Départ" required>
            <input type="text" name="destination" placeholder="Destination" required>
            <input type="date" name="date">
            <button type="submit">Rechercher</button>
        </form>
    </section>

    <!-- Section des trajets récents -->
    <section class="trajets">
        <h2>Trajets récents</h2>
        <div class="trajet-liste">
            <?php
            require_once 'models/Covoiturage.php';
            $covoiturage = new Covoiturage();
            $trajets = $covoiturage->getRecentCovoiturages();
            
            foreach ($trajets as $trajet) {
                echo "<div class='trajet'>";
                echo "<p><strong>Départ :</strong> " . htmlspecialchars($trajet['depart']) . "</p>";
                echo "<p><strong>Destination :</strong> " . htmlspecialchars($trajet['destination']) . "</p>";
                echo "<p><strong>Date :</strong> " . htmlspecialchars($trajet['date']) . "</p>";
                echo "<a href='details_covoiturage.php?id=" . $trajet['id'] . "' class='btn'>Voir détails</a>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 EcoRide - Tous droits réservés.</p>
    </footer>

</body>
</html>
