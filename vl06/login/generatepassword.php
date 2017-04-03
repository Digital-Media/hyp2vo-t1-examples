<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Password Hash</title>
</head>
<body>
<h1>Created a Hashed Password using password_hash()</h1>

<p>Please enter your desired password:</p>

<form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="post">
    <label for="password">Password:</label>
    <input type="text" id="password" name="password">
    <button type="submit">Generate Hash</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<p>Plain text password: " . $_POST["password"] ."</p>";
    echo "<p>Hashed password: " . password_hash($_POST["password"], PASSWORD_DEFAULT) . "</p>";
}
?>
</body>
</html>
