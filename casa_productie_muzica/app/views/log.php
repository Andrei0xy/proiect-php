<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <style>
        .container{
            display:grid;
            justify-content:center;
            margin-top:200px;
            background-color:orange;
        }
        body{
            background-color:orange;
        }
    </style>
</head>
<body>
<div class="container">
<h2>Login</h2>
    <form action="login.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        <input type="text" name="first_name" id="first_name" required placeholder="Enter first name"><br><br>
        <input type="text" name="last_name" id="last_name" required placeholder="Enter last name"><br><br>
        <input type="password" name="password" id="password" required placeholder="Password"><br><br>
        <input type="submit" value="Login" class="btn btn-primary">
    </form>
</div>
</body>
</html>