<!DOCTYPE html>
<html lang="en">
<head>
    <title>Custom Chuck Norris Joke</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>Create your custom Chuck Norris Joke</h1>
<form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="post">
    <label for="firstName">Enter a first name:</label>
    <input type="text" id="firstName" name="firstName"><br>
    <label for="lastName">Enter a last name:</label>
    <input type="text" id="lastName" name="lastName"><br>
    <button type="submit">Roundhouse!</button>
</form>
</body>
</html>

<?php

require "vendor/autoload.php";

if (isset($_POST["firstName"]) && isset($_POST["lastName"]))
{
    $firstName = trim(
        htmlspecialchars($_POST["firstName"], ENT_QUOTES | ENT_HTML5)
    );
    $lastName = trim(
        htmlspecialchars($_POST["lastName"], ENT_QUOTES | ENT_HTML5)
    );

    $client = new GuzzleHttp\Client();

    $response = $client->request(
        "GET",
        "https://api.icndb.com/jokes/random",
        [
            "query" => [
                "firstName" => $firstName,
                "lastName" => $lastName
            ]
        ]
    );
    $body = $response->getBody();
    $data = json_decode($body);
  echo "<p>" . $data->value->joke . "</p>";
}
