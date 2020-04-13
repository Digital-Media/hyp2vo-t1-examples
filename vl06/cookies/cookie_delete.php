<!DOCTYPE html>
<html lang="de">
<head>
    <title>Cookies</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (isset($_COOKIE["username"])) {
    echo "<p>Cookie vorhanden. Lösche...</p>";
    setcookie("username", "", ["expires" => time() - 43200]);
    unset($_COOKIE["username"]);
} else {
    echo "<p>Kein Cookie vorhanden!</p>";
}
?>
</body>
</html>
