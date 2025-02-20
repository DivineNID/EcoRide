<?php
class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    // Constructeur
    public function __construct($id, $username, $email, $password, $role, $credits) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->credits = $credits;
    }
    

    // Méthode pour créer un utilisateur
    public function create($db) {
        // Préparer et exécuter la requête d'insertion
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$this->username, $this->email, $this->password]);
    }

    // Autres méthodes...
    public function getId() {
        return $this->id;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
    
    // Méthodes pour gérer les crédits
    public function addCredits($amount) {
        $this->credits += $amount;
    }
    
    public function deductCredits($amount) {
        if ($this->credits >= $amount) {
            $this->credits -= $amount;
            return true;
        }
        return false;
    }
    public function register() {
        // Code pour enregistrer un nouvel utilisateur dans la base de données
    }
    
    public function login($email, $password) {
        // Code pour vérifier les informations d'identification de l'utilisateur
    }
    
    public function logout() {
        // Code pour gérer la déconnexion
    }
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function getUserTrips() {
        // Code pour obtenir l'historique des trajets de l'utilisateur
    }
    
}
?>
