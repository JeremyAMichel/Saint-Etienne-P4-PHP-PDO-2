<?php
require_once './utils/connect-db.php';

$sql = "SELECT * FROM patients";

try {

    $stmt = $pdo->query($sql);
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

    <ul>
        <?php
        foreach ($patients as $patient) {
        ?>

            <li>Prénom : <?= $patient['firstname'] ?> | Nom : <?= $patient['lastname'] ?></li> <a href="./profil-patient.php?patient=<?= $patient['id'] ?>">Voir</a>

        <?php
        }
        ?>

    </ul>
</body>

</html>