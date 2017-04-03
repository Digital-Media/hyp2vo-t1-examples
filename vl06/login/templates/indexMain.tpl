<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP-based Login Mechanism &ndash; Main Page</title>
</head>
<body>
<h1>Protected Main Page</h1>

{if isset($smarty.session.is_logged_in)}
    <p>Welcome {$smarty.session.username}! You were logged in successfully.</p>
    <p><a href="logout.php">Logout</a></p>
{else}
    <p>You reached this page without logging in.</p>
{/if}

</body>
</html>
