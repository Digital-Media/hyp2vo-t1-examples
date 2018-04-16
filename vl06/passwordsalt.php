<?php
define("SALT_LENGTH", 9);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Password mit Salt hashen</title>
</head>
<body>
<h1>Passwort-Hash selbst erzeugen</h1>

<p>Passwort eingeben:</p>

<form action="<?= $_SERVER["SCRIPT_NAME"]; ?>" method="post">
    <label for="password">Passwort:</label>
    <input type="text" id="password" name="password">
    <button type="submit">Hashwert erzeugen</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<p>Gewähltes Passwort: " . $_POST["password"] . "</p>";
    echo "<p>Passwort-Hash: " . generateHash($_POST["password"]) . "</p>";
}

function generateHash($plainPassword, $salt = null)
{
    if ($salt === null) {
        $salt = substr(hash("sha256", uniqid(mt_rand(), true)), 0, SALT_LENGTH);
    } else {
        $salt = substr($salt, 0, SALT_LENGTH);
    }

    return $salt . hash("sha256", $salt . $plainPassword);
}

?>
</body>
</html>
