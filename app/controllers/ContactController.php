<?php
// include_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class ContactController{
    public static function data_check(){
        $errors=[];
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['invalid_email']='Email invalid';
        }
        return $errors;
    }
    public static function email(){
        if(isset($_POST['submit'])){
            $name=$_POST['name'];
            $email=$_POST['email'];
            $message=$_POST['message'];
            $subject=$_POST['subject'];
            $errors=self::data_check();
            if(count($errors)){
                $_SESSION['mail_errors']=$errors;
                require_once "app/views/contact/email.php";
                return ;
            }
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username='your@gmail.com';
            $mail->Password='pass';
            $mail->SMTPSecure='ssl';
            $mail->Port=465;

            $mail->setFrom($email, $name);
            $mail->addAddress('your@gmail.com');
            $mail->addReplyTo($email, $name);
            $mail->isHTML(true);
            // $mail->FromName=$_POST['name'];
            $mail->Subject=$subject;
            $mail->Body="Name: $name\nEmail: $email\n\nMessage:\n$message";;

            if($mail->send()){
                echo "Email sent successfully";
                // header("Location: email.php?emailsent");
            }

            // header("Location: email.php?emailsent");
        }
        require_once "app/views/contact/email.php";
    }
    public static function email2(){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='your@gmail.com';
        $mail->Password='pass';
        $mail->SMTPSecure='ssl';
        $mail->Port=465;

        $mail->setFrom('your@gmail.com');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        // $mail->FromName=$_POST['name'];
        $mail->Subject='Your sign up';
        $mail->Body='Sign up successful. Your sign up to our website has been successful. You can now log in and visit the website.';

        $mail->send();
    }
}


?>