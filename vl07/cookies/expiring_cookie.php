<?php

if (!isset($_COOKIE["username"])) {
    setcookie("username", "Jane Doe", ["expires" => time() + 604800]);
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Cookies</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (!isset($_COOKIE["username"])) {
    echo "<p>Cookie nicht vorhanden. Setze neues Cookie...</p>";
} else {
    echo "<p>Cookie vorhanden. Lese aus...</p>";
    echo "<p>User*innenname: " . $_COOKIE["username"] . "</p>";
}
?>
</body>
</html>
