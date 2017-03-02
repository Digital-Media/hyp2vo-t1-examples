<!DOCTYPE html>
<html>
<head>
    <title>POST-Formular</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" action="post.php">
    <input type="text" name="info">
    <button type="submit">Abschicken</button>
</form>

<?php
if (isset($_POST["info"])) {
    echo "<p>" . $_POST["info"] . "</p>";
}
?>
</body>
</html>