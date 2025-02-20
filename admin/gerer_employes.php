<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.html');
    exit();
}

// Récupérer tous les employés
$stmt = $pdo->prepare("SELECT * FROM employes");
$stmt->execute();
$employes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Employés - EcoRide</title>
</head>
<body>
    <h1>Gérer les Comptes Employés</h1>

    <h2>Liste des Employés</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($employes as $employe): ?>
            <tr>
                <td><?= htmlspecialchars($employe['id']) ?></td>
                <td><?= htmlspecialchars($employe['pseudo']) ?></td>
                <td><?= htmlspecialchars($employe['email']) ?></td>
                <td>
                    <form action="suspendre_employe.php" method="POST">
                        <input type="hidden" name="employe_id" value="<?= $employe['id'] ?>">
                        <button type="submit">Suspendre</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter un Employé</h2>
    <form action="ajouter_employe.php" method="POST">
        <input type="text" name="pseudo" placeholder="Pseudo" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
