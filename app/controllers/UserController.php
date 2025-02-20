<?php
// Importer la connexion à la base de données
require_once '../config/db.php'; 

class UserController {

    // Inscription d'un nouvel utilisateur
    public function register($username, $email, $password) {
        global $pdo;

        // Hachage du mot de passe pour la sécurité
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Vérifier si l'utilisateur existe déjà
        $checkQuery = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $checkQuery->execute(['email' => $email]);

        if ($checkQuery->rowCount() > 0) {
            return "Cet email est déjà utilisé.";
        }

        // Insérer l'utilisateur dans la base de données
        $query = $pdo->prepare("INSERT INTO users (username, email, password, credits) 
                                VALUES (:username, :email, :password, 20)");
        $query->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        return "Inscription réussie.";
    }

    // Connexion de l'utilisateur
    public function login($email, $password) {
        global $pdo;

        // Vérifier si l'utilisateur existe
        $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Démarrer la session et stocker les informations de l'utilisateur
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['credits'] = $user['credits'];

            return "Connexion réussie.";
        } else {
            return "Email ou mot de passe incorrect.";
        }
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        header("Location: ../index.php");
    }

    // Mise à jour du profil utilisateur
    public function updateProfile($userId, $username, $email) {
        global $pdo;

        $query = $pdo->prepare("UPDATE users SET username = :username, email = :email 
                                WHERE id = :id");
        $query->execute([
            'username' => $username,
            'email' => $email,
            'id' => $userId
        ]);

        return "Profil mis à jour.";
    }

    // Vérification du solde de crédits
    public function checkCredits($userId) {
        global $pdo;

        $query = $pdo->prepare("SELECT credits FROM users WHERE id = :id");
        $query->execute(['id' => $userId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['credits'] : 0;
    }

    // Gestion de la participation à un covoiturage
    public function joinCarpool($userId, $tripId) {
        global $pdo;

        // Vérifier si l'utilisateur a assez de crédits
        $credits = $this->checkCredits($userId);
        if ($credits < 2) {
            return "Crédits insuffisants.";
        }

        // Vérifier s'il reste des places disponibles
        $query = $pdo->prepare("SELECT available_seats FROM trips WHERE id = :tripId");
        $query->execute(['tripId' => $tripId]);
        $trip = $query->fetch(PDO::FETCH_ASSOC);

        if ($trip['available_seats'] <= 0) {
            return "Aucune place disponible.";
        }

        // Ajouter la participation et mettre à jour le nombre de places et les crédits
        $pdo->beginTransaction();
        try {
            // Débiter les crédits de l'utilisateur
            $updateCredits = $pdo->prepare("UPDATE users SET credits = credits - 2 WHERE id = :id");
            $updateCredits->execute(['id' => $userId]);

            // Mettre à jour les places disponibles
            $updateSeats = $pdo->prepare("UPDATE trips SET available_seats = available_seats - 1 
                                          WHERE id = :tripId");
            $updateSeats->execute(['tripId' => $tripId]);

            // Enregistrer la participation
            $insertParticipation = $pdo->prepare("INSERT INTO trip_participants (user_id, trip_id) 
                                                  VALUES (:userId, :tripId)");
            $insertParticipation->execute(['userId' => $userId, 'tripId' => $tripId]);

            $pdo->commit();
            return "Participation réussie.";
        } catch (Exception $e) {
            $pdo->rollBack();
            return "Erreur : " . $e->getMessage();
        }
    }
}
?>
