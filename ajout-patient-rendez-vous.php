<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajouter un patient et un rendez-vous</h1>

    <a href="./index.php" class="back-button">Retour à l'accueil</a>

    <form method="POST" action="./process/process-add-patient-rendez-vous.php">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" required>

        <label for="birthdate">Date de naissance</label>
        <input type="date" name="birthdate" id="birthdate" required>

        <label for="phone">Téléphone</label>
        <input type="tel" name="phone" id="phone" required>

        <label for="mail">Email</label>
        <input type="email" name="mail" id="mail" required>

        <label for="dateHour">Date et heure du rendez-vous</label>
        <input type="datetime-local" name="dateHour" id="dateHour" required>

        <button type="submit">Ajouter</button>
    </form>
    
</body>
</html>