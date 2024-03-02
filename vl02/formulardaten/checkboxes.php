<!DOCTYPE html>
<html lang="de">
<head>
    <title>Mehrfach-Auswahl</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" action="checkboxes.php">
    <p>Meine Hobbys:</p>
    <label for="music">Musik:</label>
    <input type="checkbox" name="hobbies[]" value="music" id="music">
    <label for="sports">Sport:</label>
    <input type="checkbox" name="hobbies[]" value="sports" id="sports">
    <label for="reading">Lesen:</label>
    <input type="checkbox" name="hobbies[]" value="reading" id="reading">
    <label for="horses">Tiere:</label>
    <input type="checkbox" name="hobbies[]" value="animals" id="horses">
    <button type="submit">Abschicken</button>
</form>

<?php
if (isset($_POST["hobbies"])) {
    echo "<ul>";
    foreach ($_POST["hobbies"] as $hobby) {
        echo "<li>$hobby</li>";
    }
    echo "</ul>";
}
?>
</body>
</html>
