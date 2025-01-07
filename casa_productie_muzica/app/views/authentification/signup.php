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
    <h1>Sign up</h1>
    <!-- <p>
        <?php  
            if (isset($_SESSION["signup_errors"]["empty_input"])) 
                echo $_SESSION["signup_errors"]["empty_input"];
            unset($_SESSION["signup_errors"]["empty_input"]);
        ?>
    </p> -->
    <form method="post">
        <p><label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" required placeholder="Enter first name(username)" \<?php if(isset($_SESSION['signup_user']['first_name']) && !isset($_SESSION['signup_errors']['first_name'])): ?>
            value = "<?= $_SESSION['signup_user']['first_name'] ?>" <?php endif; ?>>
        </p>
        <p style="color: red;">
            <?php 
            if (isset($_SESSION['signup_errors']['first_name'])):
                echo $_SESSION['signup_errors']['first_name'];
                unset($_SESSION['signup_errors']['first_name']);
                endif;
            ?>
        </p>
        <p><label for="last_name">Last name</label>
            <input type="text" name="last_name" id="last_name" required placeholder="Enter last name" \<?php if(isset($_SESSION['signup_user']['last_name'])): ?>
            value = "<?= $_SESSION['signup_user']['last_name'] ?>" <?php endif; ?>>
        </p>
        <p><label for="email">Email</label>
            <input type="text" name="email" id="email" required placeholder="Enter email"\<?php if(isset($_SESSION['signup_user']['email']) && !isset($_SESSION['signup_errors']['email']) && !isset($_SESSION['signup_errors']['invalid_email'])): ?>
                value = "<?= $_SESSION['signup_user']['email'] ?>" <?php endif; ?>>
        </p>
        <p style="color: red;">
            <?php 
            if (isset($_SESSION['signup_errors']['invalid_email'])):
                echo $_SESSION['signup_errors']['invalid_email'];
                unset($_SESSION['signup_errors']['invalid_email']);
                endif;
            ?>
            <?php if(isset($_SESSION['signup_errors']['email'])):
                echo $_SESSION['signup_errors']['email'];
                unset($_SESSION['signup_errors']['email']);
            endif;
            ?>
        </p>
        <p><label for="password">Password</label>
            <input type="password" name="password" id="password" required placeholder="Enter password">
        </p>
        <p style="color: red;">
            <?php 
            if (isset($_SESSION['signup_errors']['password_error'])):
                echo $_SESSION['signup_errors']['password_error'];
                unset($_SESSION['signup_errors']['password_error']);
            endif;
            ?>
        </p>
        <div class="g-recaptcha" data-sitekey="6Ldaj6EqAAAAADbyvesex6gEF1v9UVMxj_6Y-_xu"></div>
        <p style="color: red;">
            <?php 
            if (isset($_SESSION['signup_errors']['captcha_error'])):
                echo $_SESSION['signup_errors']['captcha_error'];
                unset($_SESSION['signup_errors']['captcha_error']);
                endif;
            ?>
        </p>
        <input type="submit" value="Sign Up">
    </form>
    </div>
</body>
</html>