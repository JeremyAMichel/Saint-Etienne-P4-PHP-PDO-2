<?php

require_once '../utils/connect-db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location: ../index.php');
    return;
}

if (
    !isset(
        $_POST['id'],
        $_POST['dateHour'],
        $_POST['idPatients']
    )
) {
    header('location: ../index.php');
    return;
}

if (
    empty($_POST['id']) ||
    empty($_POST['dateHour']) ||
    empty($_POST['idPatients'])
) {
    header('location: ../index.php');
    return;
}

// input sanitization
$id = htmlspecialchars(trim($_POST['id']));
$dateHour = htmlspecialchars(trim($_POST['dateHour']));
$idPatients = htmlspecialchars(trim($_POST['idPatients']));

try {
    $stmt = $pdo->prepare('UPDATE appointments SET dateHour = :dateHour, idPatients = :idPatients WHERE id = :id');
    $stmt->execute([
        ':id' => $id,
        ':dateHour' => $dateHour,
        ':idPatients' => $idPatients
    ]);

    header('Location: ../liste-rendezvous.php');
} catch (\PDOException $error) {
    echo 'Erreur de requete' . $error->getMessage();
}