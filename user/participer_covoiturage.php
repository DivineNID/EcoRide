<?php
session_start();
require 'db.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login_form.html');
    exit();
}

$utilisateur_id = $_SESSION['utilisateur_id'];
$covoiturage_id = $_GET['id'];

try {
    // Vérifier le nombre de crédits de l'utilisateur
    $stmt = $pdo->prepare("SELECT credits FROM utilisateur WHERE id = :utilisateur_id");
    $stmt->execute([':utilisateur_id' => $utilisateur_id]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur['credits'] < 2) {
        echo "Vous n'avez pas assez de crédits pour participer.";
        exit();
    }

    // Mettre à jour les crédits et le nombre de places disponibles
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("UPDATE utilisateur SET credits = credits - 2 WHERE id = :utilisateur_id");
    $stmt->execute([':utilisateur_id' => $utilisateur_id]);

    $stmt = $pdo->prepare("UPDATE covoiturage SET places = places - 1 WHERE id = :covoiturage_id");
    $stmt->execute([':covoiturage_id' => $covoiturage_id]);

    $pdo->commit();

    echo "Participation confirmée ! 2 crédits ont été déduits.";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erreur : " . $e->getMessage();
}
?>
