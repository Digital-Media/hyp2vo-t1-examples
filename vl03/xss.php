<!-- Chrome benötigt die Angabe dieser Header-Daten, um die XSS-Protection auszuschalten -->
<?php header("X-XSS-Protection: 0"); ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Cross-Site-Scripting</title>
    <meta charset="utf-8">
</head>
<body>

<form method="post" action="xss.php">
    <label for="daten">Eingabe:</label>
    <input type="text" id="daten" name="daten" size="50">
    <button type="submit">Abschicken</button>
</form>

<!-- Eingabe von <script type="text/javascript">alert("XSS Alarm!")</script> triggert XSS -->

<?php
if (isset($_POST["daten"])) {
    echo $_POST["daten"];
}
?>
</body>
</html>