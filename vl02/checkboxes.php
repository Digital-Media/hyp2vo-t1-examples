<!DOCTYPE html>
<html>
<head>
    <title>Mehrfach-Auswahl</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" action="checkboxes.php">
    <p>My Hobbies:</p>
    <label for="music">Music:</label>
    <input type="checkbox" name="hobbies[]" value="music" id="music">
    <label for="sports">Sports:</label>
    <input type="checkbox" name="hobbies[]" value="sports" id="sports">
    <label for="reading">Reading:</label>
    <input type="checkbox" name="hobbies[]" value="reading" id="reading">
    <label for="horses">Horses:</label>
    <input type="checkbox" name="hobbies[]" value="horses" id="horses">
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
