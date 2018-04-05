<!DOCTYPE html>
<html lang="de">
<head>
    <title>Cookies</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (!isset($_COOKIE["user"])) {
    echo "<p>Cookie nicht vorhanden. Setze neues Cookie...</p>";
    setcookie("user", "John Doe");
} else {
    echo "<p>Cookie vorhanden. Lese aus...</p>";
    echo "<p>Username: " . $_COOKIE["user"] . "</p>";
}
?>
</body>
</html>
