<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.html');
    exit();
}


$stmt = $pdo->prepare("SELECT date_depart, COUNT(*) as nb_covoiturages FROM covoiturage GROUP BY date_depart");
$stmt->execute();
$covoiturages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques - EcoRide</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Statistiques</h1>
    
    <canvas id="covoituragesChart" width="400" height="200"></canvas>
    <script>
        const ctx = document.getElementById('covoituragesChart').getContext('2d');
        const covoituragesData = {
            labels: <?= json_encode(array_column($covoiturages, 'date_depart')) ?>,
            datasets: [{
                label: 'Nombre de Covoiturages',
                data: <?= json_encode(array_column($covoiturages, 'nb_covoiturages')) ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        };
        const myChart = new Chart(ctx, {
            type: 'line',
            data: covoituragesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
