<?php

require_once '../utils/connect-db.php';

if (!isset($_GET['id'])) {
    header('Location: ../liste-rendezvous.php');
    exit;
}

if (empty($_GET['id'])) {
    header('Location: ../liste-rendezvous.php');
    exit;
}

try {
    $stmt = $pdo->prepare('DELETE FROM appointments WHERE id = :id');
    $stmt->execute([
        ':id' => $_GET['id']
    ]);
} catch (\PDOException $error) {
    echo 'Erreur de requete' . $error->getMessage();
}

header('Location: ../liste-rendezvous.php');
exit;
