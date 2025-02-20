<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employe_id = $_POST['employe_id'];

    try {
        $stmt = $pdo->prepare("UPDATE employes SET actif = 0 WHERE id = :id");
        $stmt->execute([':id' => $employe_id]);
        echo "Employé suspendu avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
