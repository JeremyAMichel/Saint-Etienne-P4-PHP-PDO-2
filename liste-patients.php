<?php
require_once './utils/connect-db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM patients WHERE firstname LIKE :search OR lastname LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $sql = "SELECT * FROM patients";
    $stmt = $pdo->query($sql);
}

try {
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <h1>Liste des patients</h1>

    <a href="./index.php" class="back-button">Retour à l'accueil</a>

    <form method="GET" action="liste-patients.php">
        <input type="text" name="search" placeholder="Rechercher un patient" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($patients as $patient) {
            ?>
                <tr>
                    <td><?= htmlspecialchars($patient['firstname']) ?></td>
                    <td><?= htmlspecialchars($patient['lastname']) ?></td>
                    <td>
                        <a href="./profil-patient.php?patient=<?= $patient['id'] ?>" class="back-button">Voir</a>
                        <a href="./process/process-delete-patient.php?patient=<?= $patient['id'] ?>" class="delete-button">Supprimer</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>
