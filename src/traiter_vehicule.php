<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur_id = $_SESSION['utilisateur_id'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $energie = $_POST['energie'];
    $places = $_POST['places'];

    try {
        $stmt = $pdo->prepare("INSERT INTO vehicule (utilisateur_id, marque, modele, energie, places) 
                               VALUES (:utilisateur_id, :marque, :modele, :energie, :places)");
        $stmt->execute([
            ':utilisateur_id' => $utilisateur_id,
            ':marque' => $marque,
            ':modele' => $modele,
            ':energie' => $energie,
            ':places' => $places
        ]);
        echo "Véhicule ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
