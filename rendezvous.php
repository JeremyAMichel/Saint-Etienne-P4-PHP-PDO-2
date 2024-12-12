<?php
require_once './utils/connect-db.php';

try {
    $stmt = $pdo->prepare('SELECT appointments.id, appointments.dateHour, patients.id AS idPatients, patients.lastname, patients.firstname, patients.birthdate, patients.phone, patients.mail FROM appointments  JOIN patients ON appointments.idPatients = patients.id WHERE appointments.id = :id');
    $stmt->execute([
        ':id' => $_GET['id']
    ]);

    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    var_dump($appointment);
} catch (\PDOException $error) {
    echo 'Erreur de requete' . $error->getMessage();
}
