<?php
session_start();
if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'chauffeur') {
    header('Location: login_form.html');  // Rediriger si non connecté ou pas chauffeur
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisir un Covoiturage - EcoRide</title>
</head>
<body>
    <h1>Saisir un Covoiturage</h1>
    <form action="traiter_covoiturage.php" method="POST">
        <label for="depart">Adresse de départ :</label>
        <input type="text" id="depart" name="depart" required><br>

        <label for="arrivee">Adresse d’arrivée :</label>
        <input type="text" id="arrivee" name="arrivee" required><br>

        <label for="date">Date du voyage :</label>
        <input type="date" id="date" name="date" required><br>

        <label for="heure">Heure de départ :</label>
        <input type="time" id="heure" name="heure" required><br>

        <label for="prix">Prix (€) :</label>
        <input type="number" id="prix" name="prix" min="1" required><br>

        <label for="places">Nombre de places disponibles :</label>
        <input type="number" id="places" name="places" min="1" required><br>

        <button type="submit">Ajouter le covoiturage</button>
    </form>
</body>
</html>
