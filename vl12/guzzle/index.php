<?php

declare(strict_types=1);

use GuzzleHttp\Client;

require "vendor/autoload.php";

$client = new Client([
    "base_uri" => "https://httpbin.org"
]);

$getResponse = $client->get("/get", [
    "query" => ["foo" => "bar"]
]);
$postResponse = $client->post("/post", [
    "form_params" => ["foo" => "bar"]
]);

echo "<strong>The GET Response:</strong><br>";
echo $getResponse->getStatusCode() . "<br>";
echo $getResponse->getReasonPhrase() . "<br>";
echo $getResponse->getHeader("Content-Type")[0] . "<br>";
echo $getResponse->getBody()->getContents() . "</p>";

echo "<p><strong>The POST Response:</strong><br>";
echo $postResponse->getStatusCode() . "<br>";
echo $postResponse->getReasonPhrase() . "<br>";
echo $postResponse->getHeader("Content-Type")[0] . "<br>";
echo $postResponse->getBody()->getContents() . "</p>";