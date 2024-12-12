<?php


require_once './utils/connect-db.php';

try {
    $stmt = $pdo->prepare('SELECT * FROM appointments WHERE appointments.id = :id');
    $stmt->execute([
        ':id' => $_GET['id']
    ]);

    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $pdo->query('SELECT * FROM patients');
    $patients = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($patients);
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

    <h1>Modifier Rendez-vous</h1>
    <a href="./liste-rendezvous.php" class="back-button">Retour à la liste des rendez-vous</a>

    <form action="./process/process-modif-rendezvous.php" method="post">
        <input type="hidden" name="id" value="<?= $appointment['id'] ?>">

        <label for="dateHour">Date et Heure</label>
        <input type="datetime-local" name="dateHour" id="dateHour" value="<?= date('Y-m-d\TH:i', strtotime($appointment['dateHour'])) ?>">

        <label for="idPatients">Patient</label>
        <select name="idPatients" id="idPatients">
            <?php
            
            foreach ($patients as $patient) {
                ?>
                <option value="<?= $patient['id'] ?>" <?= $patient['id'] === $appointment['idPatients'] ? 'selected' : '' ?>><?= $patient['firstname'] ?> <?= $patient['lastname'] ?></option>
                <?php
                
            }
            ?>
        </select>
        <button type="submit">Modifier</button>
</body>

</html>