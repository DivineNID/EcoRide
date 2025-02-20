<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'ecoride';
    private $username = 'root';
    private $password = 'NIdivine219##';
    private $pdo;

    // Méthode pour initialiser la connexion
    public function connect() {
        if ($this->pdo == null) {
            try {
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    // Méthode pour exécuter une requête SQL
    public function query($sql, $params = []) {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
