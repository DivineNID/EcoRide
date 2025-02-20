<?php

// **Base de données**
define('DB_HOST', 'localhost');
define('DB_NAME', 'ecoride');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');

// **Paramètres de l'application**
define('APP_NAME', 'EcoRide');
define('BASE_URL', 'http://localhost:8000/');

// **Paramètres de sécurité**
define('JWT_SECRET', 'votre_secret_jwt');  // Clé secrète pour le token JWT.
define('PASSWORD_HASH_ALGO', PASSWORD_BCRYPT);  // Algorithme de hachage des mots de passe.

// **API externes**
define('GOOGLE_MAPS_API_KEY', 'votre_cle_google_maps');

// **Paramètres de session**
define('SESSION_LIFETIME', 3600);  // Durée de vie d'une session (en secondes).
define('SESSION_SECURE', true);  // Utilisation des cookies sécurisés (HTTPS).

// **Mode développement / production**
define('ENVIRONMENT', 'development');  // 'development' ou 'production'
if (ENVIRONMENT === 'development') {
    ini_set('display_errors', 1);  // Afficher les erreurs en mode développement.
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);  // Ne pas afficher les erreurs en production.
}

// **Email de l'administrateur**
define('ADMIN_EMAIL', 'admin@ecoride.com');

?>
