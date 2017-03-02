<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>PHP-basierter Login-Mechanismus &ndash; Hauptseite</title>
</head>
<body>
<h1>Geschützte Hauptseite</h1>

<p>Willkommen {$smarty.session.username}! Du hast dich erfolgreich angemeldet.</p>

<p><a href="logout.php">Logout</a></p>
</body>
</html>