<?php
require_once './utils/connect-db.php';

$search = '';
$results_per_page = 10; // Number of results per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($current_page - 1) * $results_per_page; // Offset for SQL query

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM patients WHERE firstname LIKE :search OR lastname LIKE :search LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $results_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $sql = "SELECT * FROM patients LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $results_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
}

try {
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}

// Get the total number of patients for pagination
$total_sql = "SELECT COUNT(*) FROM patients";
if (isset($_GET['search'])) {
    $total_sql .= " WHERE firstname LIKE :search OR lastname LIKE :search";
    $total_stmt = $pdo->prepare($total_sql);
    $total_stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $total_stmt->execute();
} else {
    $total_stmt = $pdo->query($total_sql);
}
$total_patients = $total_stmt->fetchColumn();
$total_pages = ceil($total_patients / $results_per_page);
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
    <h1>Liste des patients</h1>

    <a href="./index.php" class="back-button">Retour à l'accueil</a>

    <form method="GET" action="liste-patients.php">
        <input type="text" name="search" placeholder="Rechercher un patient" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($patients as $patient) {
            ?>
                <tr>
                    <td><?= htmlspecialchars($patient['firstname']) ?></td>
                    <td><?= htmlspecialchars($patient['lastname']) ?></td>
                    <td>
                        <a href="./profil-patient.php?patient=<?= $patient['id'] ?>" class="back-button">Voir</a>
                        <a href="./process/process-delete-patient.php?patient=<?= $patient['id'] ?>" class="delete-button">Supprimer</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?= $current_page - 1 ?>&search=<?= htmlspecialchars($search) ?>">Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>" <?= $i == $current_page ? 'class="active"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?= $current_page + 1 ?>&search=<?= htmlspecialchars($search) ?>">Suivant</a>
        <?php endif; ?>
    </div>
</body>

</html>
