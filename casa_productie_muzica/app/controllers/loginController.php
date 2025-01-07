<?php
require_once "app/models/User.php";
require_once "app/controllers/ContactController.php";

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
    public static function signup_check(){
        $errors=[];
        $name=User::getNames($_POST['first_name']);
        $email=User::getUserByEmail($_POST['email']);
        // if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['pwd'])){
        //     $errors['empty_input']='Fill in all fields';
        // }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['invalid_email']='Email invalid';
        }
        if($name){
            $errors['first_name']='First name taken';
        }
        if($email){
            $errors['email']='Email is already used';
        }
        if (isset($_POST['password']) && strlen($_POST['password']) < 8) {
            $errors['password_error'] = 'Password must be at least 8 characters';
        }
        return $errors;
    }

    public static function signup(){
        if(!isset($_POST["email"])){
            require_once "app/views/authentification/signup.php";
            return;
        }

        $recaptcha = $_POST["g-recaptcha-response"];

        $secret_key='6Ldaj6EqAAAAALgutVH2vHkCQmvGvkWOj8pUnz3z';
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
                . $secret_key . '&response=' . $recaptcha;
        $response = file_get_contents($url);
        $response = json_decode($response);
        $_SESSION['signup_user']=$_POST;
        $errors=self::signup_check();
        if(count($errors)){
            $_SESSION['signup_errors']=$errors;
            require_once "app/views/authentification/signup.php";
        }
        else if(!($response->success==true)) {
            $_SESSION["signup_errors"]["captcha_error"]="Error in google reCaptacha";
            require_once "app/views/authentification/signup.php";
        }
        else{
            $first_name=htmlentities($_POST["first_name"]);
            $last_name=htmlentities($_POST["last_name"]);
            $email = htmlentities($_POST["email"]);
            $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
            User::createUser($first_name,$last_name,$email,$pass,3);
            $_SESSION['success']='Sign up successfull';
            ContactController::email2();
            header("Location: signupsuccess");
        }
        if(!isset($_SESSION['signup_user'])){
            $_SESSION['signup_user']=[
                "first_name"=>"",
                "last_name"=>"",
                "email"=>""
            ];
        }

    }
    public static function success(){
        require_once "app/views/authentification/signupsuccess.php";
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
