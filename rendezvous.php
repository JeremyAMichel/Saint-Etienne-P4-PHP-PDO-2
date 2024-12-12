<?php
require_once './utils/connect-db.php';

try {
    $stmt = $pdo->prepare('SELECT appointments.id, appointments.dateHour, patients.id AS idPatients, patients.lastname, patients.firstname, patients.birthdate, patients.phone, patients.mail FROM appointments  JOIN patients ON appointments.idPatients = patients.id WHERE appointments.id = :id');
    $stmt->execute([
        ':id' => $_GET['id']
    ]);

    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
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
    
    <h1>Rendez-vous</h1>
    <a href="./liste-rendezvous.php" class="back-button">Retour à la liste des rendez-vous</a>
    
    <table>
        <thead>
            <tr>
                <th>Date et Heure</th>
                <th>Patient</th>
                <th>Date de naissance</th>
                <th>Téléphone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $appointment['dateHour'] ?></td>
                <td><?= $appointment['firstname'] ?> <?= $appointment['lastname'] ?></td>
                <td><?= $appointment['birthdate'] ?></td>
                <td><?= $appointment['phone'] ?></td>
                <td><?= $appointment['mail'] ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
