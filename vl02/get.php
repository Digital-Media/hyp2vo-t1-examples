<!DOCTYPE html>
<html>
<head>
    <title>GET-Formular</title>
    <meta charset="utf-8">
</head>
<body>
<form method="get" action="get.php">
    <input type="text" name="info">
    <button type="submit">Abschicken</button>
</form>

<?php
if (isset($_GET["info"])) {
    echo "<p>" . $_GET["info"] . "</p>";
}
?>
</body>
</html>
