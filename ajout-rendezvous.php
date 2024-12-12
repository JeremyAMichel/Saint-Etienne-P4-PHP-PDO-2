<?php 
require_once './utils/connect-db.php';

try {
    
    $stmt = $pdo->query('SELECT * FROM patients');

    $patients = $stmt->fetchAll();

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
    <form action="./process/process-ajout-rendezvous.php" method="post">
        <label for="dateHour">Date et Heure :</label>
        <input type="datetime-local" name="dateHour" id="dateHour" required>

        <select name="idPatients" id="idPatients">
            <?php foreach ($patients as $patient) { ?>
                <option value="<?= $patient['id'] ?>"><?= $patient['firstname'] . ' ' . $patient['lastname'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Créer rendez-vous">
    </form>
    
</body>
</html>