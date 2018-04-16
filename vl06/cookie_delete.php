<!DOCTYPE html>
<html lang="de">
<head>
    <title>Cookies</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (isset($_COOKIE["user"])) {
    echo "<p>Cookie vorhanden. Lösche...</p>";
    setcookie("user", "", time() - 43200);
    unset($_COOKIE["user"]);
} else {
    echo "<p>Kein Cookie vorhanden!</p>";
}
?>
</body>
</html>
