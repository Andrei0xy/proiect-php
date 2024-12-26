<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="container">
    <h1>Login</h1>
    <p>
        <?php  
            if (isset($_SESSION["login_error"])) 
                echo $_SESSION["login_error"];
            unset($_SESSION["login_error"]);
        ?>
    <form method="post">
    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token'] ?>">
        <p><label for="email">Email</label>
            <input type="text" name="email" id="email" required placeholder="Enter email">
        </p>
        <p><label for="password">Password</label>
            <input type="password" name="password" id="password" required placeholder="Enter password">
        </p>
        <div class="g-recaptcha" data-sitekey="6Ldaj6EqAAAAADbyvesex6gEF1v9UVMxj_6Y-_xu"></div>
        <input type="submit" value="Login">
    </form>
    </div>
</body>
</html>