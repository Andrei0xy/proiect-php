<?php
require_once "app/models/User.php";

class loginController{
    public static function log(){
        
        if (isset($_SESSION["request_user"])){
            header("Location: /casa_productie_muzica");
            return;
        }
        if(!isset($_POST["email"])){
            require_once "app/views/authentification/login.php";
            return;
        }

        
        $email = htmlentities($_POST["email"]);
        $pass = $_POST["password"];
        $recaptcha = $_POST["g-recaptcha-response"];

        $secret_key='6Ldaj6EqAAAAALgutVH2vHkCQmvGvkWOj8pUnz3z';
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
                . $secret_key . '&response=' . $recaptcha;
        $response = file_get_contents($url);
        $response = json_decode($response);
        $user = User::getUserByEmail($email);
        // var_dump($user);
        if(!$user || !password_verify($pass, $user["pwd"])){
            $_SESSION["login_error"] = "Invalid email or password!";
            require_once "app/views/authentification/login.php";
        }
        else if(!($response->success==true)) {
            $_SESSION["login_error"]="Error in google reCaptacha";
            require_once "app/views/authentification/login.php";
        }
        else {
            // login successful
            if($_POST['csrf_token']==$_SESSION['csrf_token']){
                if(time() >= $_SESSION['token_expire']){
                    exit("Token expired! Reload the form");
                }
                $_SESSION["request_user"] = $user;
                header("Location: /casa_productie_muzica");
                unset($_SESSION['csrf_token']);
                unset($_SESSION['token_expire']);
            }
            else{
                exit("Invalid token!");
            }
            
        }
    }
    public static function logout(){
        session_start();
        session_destroy();
        header("Location: /casa_productie_muzica");
    }

    public static function home_page(){
        require_once "app/views/home.php";
    }
    }
?>
