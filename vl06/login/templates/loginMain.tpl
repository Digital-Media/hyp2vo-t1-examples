<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP-based Login Mechanism &ndash; Login Page</title>
</head>
<body>
<h1>Login Page</h1>

<p>Please use your credentials to log in.</p>
{if isset($errorMessages) && count($errorMessages) > 0}
    <ul>
        {foreach $errorMessages as $error}
            <li>{$error}</li>
        {/foreach}
    </ul>
{/if}

<form action="{$smarty.server.SCRIPT_NAME}" method="post">
    <div>
        <label for="{$username->getName()}">User Name*</label><br>
        <input type="text" id="{$username->getName()}" name="{$username->getName()}" value="{$username->getValue()}">
    </div>
    <div>
        <label for="{$passwordKey}">Password*</label><br>
        <input type="password" id="{$passwordKey}" name="{$passwordKey}">
    </div>
    <div>
        <button type="submit">Log me in</button>
    </div>
</form>
</body>
</html>
