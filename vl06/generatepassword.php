<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Password Hash mit PHP-Methoden</title>
</head>
<body>
<h1>Einen Passwort-Hash mit password_hash() erzeugen</h1>

<p>Passwort eingeben:</p>

<form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="post">
    <label for="password">Passwort:</label>
    <input type="text" id="password" name="password">
    <button type="submit">Hashwert erzeugen</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<p>Gewähltes Passwort: " . $_POST["password"] . "</p>";
    echo "<p>Passwort-Hash: " . password_hash($_POST["password"], PASSWORD_DEFAULT) . "</p>";
}
?>
</body>
</html>
