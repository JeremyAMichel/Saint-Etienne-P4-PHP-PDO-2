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
</head>

<body>

    <a href="./modif-patient.php?patient=<?= $patient['id'] ?>">Modifier le patient</a>
    <a href="./process/process-delete-patient.php?patient=<?= $patient['id'] ?>" style="color: red">Supprimer le patient</a>

    <p>Prenom : <?= $patient['firstname'] ?></p>
    <p>Nom : <?= $patient['lastname'] ?></p>
    <p>Date de naissance : <?= $patient['birthdate'] ?></p>
    <p>Phone : <?= $patient['phone'] ?></p>
    <p>Email : <?= $patient['mail'] ?></p>


    <a href="./index.php">Retour à l'accueil</a>

</body>

</html>