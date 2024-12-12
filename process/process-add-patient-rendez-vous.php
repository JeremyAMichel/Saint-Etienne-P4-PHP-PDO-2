<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location: ../index.php');
    return;
}

if (
    !isset(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['birthdate'],
        $_POST['phone'],
        $_POST['mail'],
        $_POST['dateHour']
    )
) {
    header('location: ../index.php');
    return;
}

if (
    empty($_POST['firstname']) ||
    empty($_POST['lastname']) ||
    empty($_POST['birthdate']) ||
    empty($_POST['phone']) ||
    empty($_POST['mail']) ||
    empty($_POST['dateHour'])
) {
    header('location: ../index.php');
    return;
}

// input sanitization
$firstname = htmlspecialchars(trim($_POST['firstname']));
$lastname = htmlspecialchars(trim($_POST['lastname']));
$birthdate = htmlspecialchars(trim($_POST['birthdate']));
$phone = htmlspecialchars(trim($_POST['phone']));
$mail = htmlspecialchars(trim($_POST['mail']));
$dateHour = htmlspecialchars(trim($_POST['dateHour']));

require_once '../utils/connect-db.php';

$sql = "INSERT INTO patients (firstname, lastname, birthdate, phone, mail) VALUES (:firstname, :lastname, :birthdate, :phone, :mail)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':birthdate' => $birthdate,
        ':phone' => $phone,
        ':mail' => $mail
    ]);
    $patientId = $pdo->lastInsertId();

    $sqlRendezVous = "INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatients)";
    $stmtRendezVous = $pdo->prepare($sqlRendezVous);
    $stmtRendezVous->execute([
        ':dateHour' => $dateHour,
        ':idPatients' => $patientId
    ]);

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


header('location: ../liste-patients.php');
