<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./process/process-ajout-patient.php" method="post">
        <label for="firstname">Prénom : </label>
        <input type="text" name="firstname" id="firstname">

        <label for="lastname">Nom : </label>
        <input type="text" name="lastname" id="lastname">

        <label for="birthdate">Date de naissance : </label>
        <input type="date" name="birthdate" id="birthdate">

        <label for="phone">Numéro de téléphone</label>
        <input type="tel" name="phone" id="phone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="Exemple: 06 12 34 56 78">

        <label for="mail">Adresse mail</label>
        <input type="email" name="mail" id="mail">


        <input type="submit" value="Ajouter patient">
    </form>

</body>

</html>