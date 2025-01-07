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
        .container a{
            padding:20px;
        }
        body{
            background-color:orange;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="container">
    <?php if(isset($_SESSION['success'])):
        echo $_SESSION['success'];    
        unset ($_SESSION['signup_user']);
    ?>
    <p><a href="/casa_productie_muzica/">Back</a>      <a href="login">Login</a></p>
    <?php endif; ?>
    </div>
</body>
</html>