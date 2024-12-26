<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Home page</title>
</head>
<body>
    <?php if (isset($_SESSION["request_user"])): ?>
        <h1>Welcome <?= $_SESSION["request_user"]["first_name"] ?></h1>
        <ul>
            <li><a href="users/index">Users</a></li>
            <li><a href="artists/index">Artists</a></li>
            <li><a href="authentification/logout">Logout</a></li>
        </ul>
    <?php else: ?>
        <h1>Welcome</h1>
        <a href="authentification/login">Login</a>
    <?php endif; ?>
</body>
</html>