<?php

require_once './utils/connect-db.php';

$sql = "SELECT * FROM patients WHERE id = :id";

try {

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['patient']
    ]);


    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
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

    <a href="./liste-patients.php" class="back-button">Retour à la liste de patients</a>

    <form action="./process/process-modif-patient.php" method="post">
        <label for="firstname">Prénom : </label>
        <input type="text" name="firstname" id="firstname" value="<?= $patient['firstname'] ?>">

        <label for="lastname">Nom : </label>
        <input type="text" name="lastname" id="lastname" value="<?= $patient['lastname'] ?>">

        <label for="birthdate">Date de naissance : </label>
        <input type="date" name="birthdate" id="birthdate" value="<?= $patient['birthdate'] ?>">

        <label for="phone">Numéro de téléphone</label>
        <input type="tel" name="phone" id="phone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="Exemple: 06 12 34 56 78" value="<?= $patient['phone'] ?>">

        <label for="mail">Adresse mail</label>
        <input type="email" name="mail" id="mail" value="<?= $patient['mail'] ?>">


        <input type="hidden" name="idPatient" value="<?= $patient['id'] ?>">


        <input type="submit" value="Modifier patient">
    </form>

</body>

</html>