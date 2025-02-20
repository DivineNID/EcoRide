<?php
require_once '../config/database.php';
require_once '../models/Covoiturage.php';

class CovoiturageController {
    
    // Ajouter un covoiturage
    public function createCovoiturage($data) {
        $covoiturage = new Covoiturage();
        $covoiturage->setDepart($data['depart']);
        $covoiturage->setDestination($data['destination']);
        $covoiturage->setDate($data['date']);
        $covoiturage->setPlaces($data['places']);
        $covoiturage->setConducteurId($data['conducteur_id']);
        
        if ($covoiturage->save()) {
            return "Covoiturage ajouté avec succès !";
        } else {
            return "Erreur lors de l'ajout.";
        }
    }

    // Récupérer tous les covoiturages
    public function getCovoiturages() {
        $covoiturage = new Covoiturage();
        return $covoiturage->findAll();
    }

    // Rejoindre un covoiturage
    public function joinCovoiturage($covoiturageId, $userId) {
        $covoiturage = new Covoiturage();
        return $covoiturage->addPassenger($covoiturageId, $userId);
    }

    // Supprimer un covoiturage
    public function deleteCovoiturage($id) {
        $covoiturage = new Covoiturage();
        return $covoiturage->delete($id);
    }
}
?>
