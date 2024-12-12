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
</head>
<body>
    
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
                        <a href="rendezvous.php?id=<?= $appointment['id'] ?>">Modifier</a>
                        <a href="rendezvous.php?id=<?= $appointment['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>