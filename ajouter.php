<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

$pdo = getPDO();
$erreur = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim((string) ($_POST['nom'] ?? ''));
    $prenom = trim((string) ($_POST['prenom'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $serviceId = (int) ($_POST['service_id'] ?? 0);
    $dateEmbauche = (string) ($_POST['date_embauche'] ?? '');

    if ($nom === '' || $prenom === '' || $email === '') {
        $erreur = 'Nom, prénom et email sont obligatoires.';
    } else {
        $stmt = $pdo->prepare(
            'INSERT INTO employes (nom, prenom, email, service_id, date_embauche)
             VALUES (:nom, :prenom, :email, :service_id, :date_embauche)'
        );
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'service_id' => $serviceId ?: null,
            'date_embauche' => $dateEmbauche ?: null,
        ]);

        header('Location: index.php');
        exit;
    }
}

$services = $pdo->query('SELECT id, nom FROM services ORDER BY nom')->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un employé — Annuaire RH Meridia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Ajouter un employé</h1>
        <a class="bouton" href="index.php">Retour à l'annuaire</a>
    </header>

    <?php if ($erreur !== null): ?>
        <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom
            <input type="text" name="nom" required>
        </label>
        <label>Prénom
            <input type="text" name="prenom" required>
        </label>
        <label>Email
            <input type="email" name="email" required>
        </label>
        <label>Service
            <select name="service_id">
                <option value="">—</option>
                <?php foreach ($services as $service): ?>
                    <option value="<?= (int) $service['id'] ?>">
                        <?= htmlspecialchars($service['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Date d'embauche
            <input type="date" name="date_embauche">
        </label>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
