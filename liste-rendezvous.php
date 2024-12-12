<?php

require_once './utils/connect-db.php';

try {
    
    $stmt = $pdo->query('SELECT appointments.id, appointments.dateHour, patients.firstname, patients.lastname FROM appointments JOIN patients ON appointments.idPatients = patients.id');

    $appointments = $stmt->fetchAll();

} catch (\PDOException $error) {
    echo 'Erreur de requete' . $error->getMessage();
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

    <h1>Liste des rendez-vous</h1>
    <a href="./index.php" class="back-button">Retour à l'accueil</a>
    
    <table>
        <thead>
            <tr>
                <th>Date et Heure</th>
                <th>Patient</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $appointment) { ?>
                <tr>
                    <td><?= $appointment['dateHour'] ?></td>
                    <td><?= $appointment['firstname'] ?> <?= $appointment['lastname'] ?></td>
                    <td>
                        <a href="rendezvous.php?id=<?= $appointment['id'] ?>">Voir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>