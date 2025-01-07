<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/views/home.css" type="text/css">
    <title>Home page</title>

    <style>
    .container>h1{
        grid-column: 1/5;
    }
    .container .contact{
        align-items: flex-end;
    }
    </style>
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION["request_user"])): ?>
        <h1>Welcome <?= $_SESSION["request_user"]["first_name"] ?></h1>
            <h2><a href="users/index">Users</a></h2>
            <h2><a href="artists/index">Artists</a></h2>
            <h2><a href="albums/index">Albums</a></h2>
            <h2><a href="authentification/logout">Logout</a></h2>
    <?php else: ?>
        <h1>Welcome</h1>
        <p><a href="authentification/signup">Sign up</a></p>
        <p><a href="authentification/login">Login</a></p>
    <?php endif; ?>
    <div class="contact">
        <h3>Contact: </h3>
        <p><a href="contact/email">Contact Us</a></p>
    </div>
</div>
</body>
</html>