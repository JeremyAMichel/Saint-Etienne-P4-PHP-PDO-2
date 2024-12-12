<?php

require_once './utils/connect-db.php';

$sql = "SELECT * FROM patients WHERE id = :id";

try {

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['patient']
    ]);


    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $pdo->prepare('SELECT * FROM appointments WHERE idPatients = :id');
    $stmt2->execute([
        ':id' => $_GET['patient']
    ]);

    $appointments = $stmt2->fetchAll(PDO::FETCH_ASSOC);
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

    <h1>Profil du patient</h1>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de naissance</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $patient['firstname'] ?></td>
                <td><?= $patient['lastname'] ?></td>
                <td><?= $patient['birthdate'] ?></td>
                <td><?= $patient['phone'] ?></td>
                <td><?= $patient['mail'] ?></td>
                <td>
                    <a href="./modif-patient.php?patient=<?= $patient['id'] ?>" class="edit-button">Modifier</a>
                </td>
            </tr>
        </tbody>
    </table>

    <h2>Rendez-vous</h2>

    <table>
        <thead>
            <tr>
                <th>Date et Heure</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($appointments as $appointment) {
            ?>
                <tr>
                    <td><?= $appointment['dateHour'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>


    <a href="./index.php" class="back-button">Retour à l'accueil</a>

</body>

</html>