<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avis_id = $_POST['avis_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM avis WHERE id = :id");
        $stmt->execute([':id' => $avis_id]);
        echo "Avis refusé avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
