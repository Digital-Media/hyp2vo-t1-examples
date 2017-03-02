<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Password Hash</title>
</head>
<body>
<h1>Passwort Hash mittels password_hash() erzeugen</h1>

<p>Bitte das gewünschte Passwort eingeben:</p>

<form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="post">
    <label for="password">Passwort:</label>
    <input type="text" id="password" name="password">
    <button type="submit">Hash erzeugen</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<p>Klartext-Passwort: " . $_POST["password"] ."</p>";
    echo "<p>Passwort-Hash: " . password_hash($_POST["password"], PASSWORD_DEFAULT) . "</p>";
}
?>
</body>
</html>