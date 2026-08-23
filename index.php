<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

$pdo = getPDO();
$stmt = $pdo->query(
    'SELECT employes.id, employes.nom, employes.prenom, employes.email,
            employes.date_embauche, services.nom AS service
     FROM employes
     LEFT JOIN services ON services.id = employes.service_id
     ORDER BY employes.nom, employes.prenom'
);
$employes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annuaire RH — Meridia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Annuaire RH — Meridia</h1>
        <a class="bouton" href="ajouter.php">Ajouter un employé</a>
    </header>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Service</th>
                <th>Email</th>
                <th>Date d'embauche</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $employe): ?>
            <tr>
                <td><?= htmlspecialchars($employe['nom']) ?></td>
                <td><?= htmlspecialchars($employe['prenom']) ?></td>
                <td><?= htmlspecialchars($employe['service'] ?? '—') ?></td>
                <td><?= htmlspecialchars($employe['email']) ?></td>
                <td><?= htmlspecialchars($employe['date_embauche']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
