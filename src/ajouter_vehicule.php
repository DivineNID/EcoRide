<?php
session_start();
require 'db.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login_form.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Véhicule - EcoRide</title>
</head>
<body>
    <h1>Ajouter un Véhicule</h1>
    <form action="traiter_vehicule.php" method="POST">
        <label for="marque">Marque :</label>
        <input type="text" id="marque" name="marque" required><br>

        <label for="modele">Modèle :</label>
        <input type="text" id="modele" name="modele" required><br>

        <label for="energie">Type d'énergie :</label>
        <select id="energie" name="energie">
            <option value="Essence">Essence</option>
            <option value="Diesel">Diesel</option>
            <option value="Électrique">Électrique</option>
        </select><br>

        <label for="places">Nombre de places :</label>
        <input type="number" id="places" name="places" required><br>

        <button type="submit">Ajouter le Véhicule</button>
    </form>
</body>
</html>
