<?php
// Inclure le fichier PHPMailer via Composer ou l'importer manuellement
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Chargement via Composer

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true); // Instanciation de PHPMailer

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com';  // Serveur SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'votre_email@example.com'; // Email de l'expéditeur
        $mail->Password   = 'votre_mot_de_passe'; // Mot de passe de l'email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Paramètres de l'email
        $mail->setFrom('votre_email@example.com', 'EcoRide');
        $mail->addAddress($to); // Adresse du destinataire

        $mail->isHTML(true); // Email au format HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Envoi de l'email
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Erreur : l'email n'a pas pu être envoyé. PHPMailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>
