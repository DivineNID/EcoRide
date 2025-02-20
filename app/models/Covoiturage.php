<?php
require_once '../config/database.php';

class Covoiturage {
    private $db;
    private $id;
    private $depart;
    private $destination;
    private $date;
    private $places;
    private $conducteur_id;

    // Constructeur
    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Définir les attributs
    public function setDepart($depart) { $this->depart = $depart; }
    public function setDestination($destination) { $this->destination = $destination; }
    public function setDate($date) { $this->date = $date; }
    public function setPlaces($places) { $this->places = $places; }
    public function setConducteurId($conducteur_id) { $this->conducteur_id = $conducteur_id; }

    // Ajouter un covoiturage dans la base
    public function save() {
        $query = "INSERT INTO covoiturages (depart, destination, date, places, conducteur_id) 
                  VALUES (:depart, :destination, :date, :places, :conducteur_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':depart' => $this->depart,
            ':destination' => $this->destination,
            ':date' => $this->date,
            ':places' => $this->places,
            ':conducteur_id' => $this->conducteur_id
        ]);
    }

    // Récupérer tous les covoiturages
    public function findAll() {
        $query = "SELECT * FROM covoiturages";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un covoiturage par ID
    public function findById($id) {
        $query = "SELECT * FROM covoiturages WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter un passager au covoiturage
    public function addPassenger($covoiturageId, $userId) {
        $query = "INSERT INTO participants (covoiturage_id, user_id) VALUES (:covoiturageId, :userId)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':covoiturageId' => $covoiturageId,
            ':userId' => $userId
        ]);
    }

    // Supprimer un covoiturage
    public function delete($id) {
        $query = "DELETE FROM covoiturages WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>
