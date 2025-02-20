<?php
session_start();
require_once '../config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// Récupérer les statistiques
$totalUsers = $conn->query("SELECT COUNT(*) FROM utilisateurs")->fetchColumn();
$totalCovoiturages = $conn->query("SELECT COUNT(*) FROM covoiturages")->fetchColumn();
$recentCovoiturages = $conn->query("SELECT * FROM covoiturages ORDER BY date DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord | EcoRide</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Tableau de Bord</h2>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Utilisateurs</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $totalUsers ?> inscrits</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Covoiturages</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $totalCovoiturages ?> trajets</h5>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-4">Derniers Covoiturages</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Départ</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Places restantes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentCovoiturages as $covoiturage) : ?>
                <tr>
                    <td><?= htmlspecialchars($covoiturage['depart']) ?></td>
                    <td><?= htmlspecialchars($covoiturage['destination']) ?></td>
                    <td><?= htmlspecialchars($covoiturage['date']) ?></td>
                    <td><?= htmlspecialchars($covoiturage['places_restantes']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
