<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Password Hash mit PHP-Methoden</title>
</head>
<body>
<h1>Einen Passwort-Hash mit password_hash() erzeugen</h1>

<form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="post">
    <p>
        <label for="password">Passwort:</label><br>
        <input type="text" id="password" name="password">
    </p>
    <p>
        <label for="algo">Algorithmus wählen:</label><br>
        <select id="algo" name="algo">
            <option value="<?= PASSWORD_DEFAULT ?>">PASSWORD_DEFAULT</option>
            <option value="<?= PASSWORD_BCRYPT ?>">PASSWORD_BCRYPT</option>
            <option value="<?= PASSWORD_ARGON2I ?>">PASSWORD_ARGON2I</option>
            <option value="<?= PASSWORD_ARGON2ID ?>">PASSWORD_ARGON2ID</option>
        </select>
    </p>
    <p>
        <button type="submit">Hashwert erzeugen</button>
    </p>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<p>Gewähltes Passwort: " . $_POST["password"] . "</p>";
    echo "<p>Passwort-Hash: " . password_hash($_POST["password"], $_POST["algo"]) . "</p>";
}
?>
</body>
</html>
