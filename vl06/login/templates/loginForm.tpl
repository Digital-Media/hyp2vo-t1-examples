<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>PHP-basierter Login-Mechanismus &ndash; Login-Seite</title>
</head>
<body>
<h1>Login</h1>

<p>Bitte um Ihre Angaben, mit "*" markierte Felder müssen ausgefüllt werden.</p>
{if count($errorMessages) > 0}
    <ul>
        {foreach $errorMessages as $error}
            <li>{$error}</li>
        {/foreach}
    </ul>
{/if}
<form action="{$smarty.server.SCRIPT_NAME}" method="post">
    {include file="loginFields.tpl"}
</form>
</body>
</html>