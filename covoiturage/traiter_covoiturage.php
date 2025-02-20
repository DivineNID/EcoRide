<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur_id = $_SESSION['utilisateur_id'];
    $depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $prix = $_POST['prix'];
    $places = $_POST['places'];

    try {
        $stmt = $pdo->prepare("INSERT INTO covoiturage (utilisateur_id, depart, arrivee, date, heure, prix, places) VALUES (:utilisateur_id, :depart, :arrivee, :date, :heure, :prix, :places)");
        $stmt->execute([
            ':utilisateur_id' => $utilisateur_id,
            ':depart' => $depart,
            ':arrivee' => $arrivee,
            ':date' => $date,
            ':heure' => $heure,
            ':prix' => $prix,
            ':places' => $places
        ]);

        echo "Covoiturage ajouté avec succès !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
?>
