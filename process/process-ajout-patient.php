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
        $_POST['mail']
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
    empty($_POST['mail'])
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




// a remplir en fonction de vos prerequis
// if(
//     strlen($firstName) > 50 ||
//     strlen($lastName) > 50 ||
//     $age > 120 ||
//     $age < 0
// ) {
    // redirection si c'est pas bon
// }


// optionnel regex
// if (!preg_match('[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]', $email)) {
//     die("l'email est pas conforme");
// }

// etc .......



// mon code une fois que toute les données sont bonnes

// var_dump($_POST);
// die();

require_once '../utils/connect-db.php';

$sql = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail);";

try {
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':lastname' => $lastname,
        ':firstname' => $firstname ,
        ':birthdate' => $birthdate, 
        ':phone' => $phone,
        ':mail' => $mail
    ]);

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


header('Location: ../index.php');
exit;