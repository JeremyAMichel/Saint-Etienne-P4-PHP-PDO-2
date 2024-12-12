<?php

require_once '../utils/connect-db.php';

if (isset($_GET['patient']) && !empty($_GET['patient'])) {
    $id = $_GET['patient'];



    try {

        // Check if the patient ID exists
        $sqlCheck = "SELECT COUNT(*) FROM patients WHERE id = :id";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->execute([':id' => $id]);
        $patientExists = $stmtCheck->fetchColumn();

        if ($patientExists) {
            // Delete the patient's appointments
            $sqlDeleteAppointments = "DELETE FROM appointments WHERE idPatients = :id";
            $stmtDeleteAppointments = $pdo->prepare($sqlDeleteAppointments);
            $stmtDeleteAppointments->execute([':id' => $id]);

            // Delete the patient
            $sqlDeletePatient = "DELETE FROM patients WHERE id = :id";
            $stmtDeletePatient = $pdo->prepare($sqlDeletePatient);
            $stmtDeletePatient->execute([':id' => $id]);
        }

        header('Location: ../liste-patients.php');
        exit;
    } catch (\PDOException $error) {
        echo 'Erreur de requete' . $error->getMessage();
    }
} else {
    header('Location: ../liste-patients.php');
}
