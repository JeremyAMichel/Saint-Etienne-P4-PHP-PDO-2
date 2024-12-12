<?php


require_once '../utils/connect-db.php';


$sql = "DELETE FROM patients WHERE id= :id";


try {
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id']
    ]);

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}