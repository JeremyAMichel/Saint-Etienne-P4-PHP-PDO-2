<?php
require_once '../utils/connect-db.php';

if (
    !isset(
        $_POST['dateHour'],
        $_POST['idPatients']
    )
) {
    header('location: ../ajout-rendezvous.php');
    return;
}

if (
    empty($_POST['dateHour']) ||
    empty($_POST['idPatients'])
) {
    header('location: ../ajout-rendezvous.php');
    return;
}

$dateHour = htmlspecialchars(trim($_POST['dateHour']));
$idPatients = htmlspecialchars(trim($_POST['idPatients']));

try {
    $stmt = $pdo->prepare('INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatients)');
    $stmt->execute([
        ':dateHour' => $dateHour,
        ':idPatients' => $idPatients
    ]);

    
} catch (\PDOException $error) {
    echo 'Erreur de requete' . $error->getMessage();
}

header('location: ../liste-rendezvous.php');