<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);

require_once 'auth.php';
$user = new Auth();

// Handler register request
if(isset($_POST['action']) && $_POST['action'] == 'register'){
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $pass = $user->test_input($_POST['password']);

    $hpass = password_hash($pass, PASSWORD_DEFAULT);
    if($user->user_exist($email)){
        echo $user->showMessage('warning','This E-mail already exist!');
    }else{
        if($user->register($name,$email,$hpass)){
            echo $user->showMessage('success','Register successfully');
            $_SESSION['user'] = $email;
            
        }else{
            echo $user->showMessage('danger','Something went wrong, Try latter!');
        }
    }
}

// Handler login request
if(isset($_POST['action']) && $_POST['action'] == 'login'){
    $email = $user->test_input($_POST['email']);
    $pass = $user->test_input($_POST['password']);

    $logedInUser = $user->login($email);
    if($logedInUser != null){
        if(password_verify($pass,$logedInUser['password'])){
            if(!empty($_POST['rem'])){
                setcookie("email",$email, time()+(30*24*60*60),'/');
                setcookie("password",$pass, time()+(30*24*60*60),'/');
            }else{
                setcookie("email","",1,'/');
                setcookie("password","",1,'/');
            }
            echo 'login';
            $_SESSION['user'] = $email;
        }else{
            echo $user->showMessage('danger','Password incorrect!');
        }
    }else{
        echo $user->showMessage('danger','User not found!');
    }
}

// Handler forgot password
if(isset($_POST['action'])  && $_POST['action'] == 'forgot'){
    $email = $user->test_input($_POST['email']);
    $user_found = $user->currentUser($email);

    if($user_found!= null){
        $token = uniqid();
        $token = str_shuffle($token);
        $user->forgot_password($token,$email);

        try{
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = Database::USERNAME;         
            $mail->Password   = Database::PASSWORD;                       
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;      
            
            $mail->setFrom(Database::USERNAME,'PNakCoding');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Reset Password";
            $mail->Body = "
            <h3>
            Click the below link to reset password.<br>
            <a href='http://localhost:7070/cookies/userSystem/reset-pass.php?email=".$email."&token=".$token." '>
            http://localhost:7070/cookies/userSystem/reset-pass.php?email=".$email."&token=".$token."
            </a>
            <br>Regards Admin Mr.RatanakDevelopment!
            </h3>
            ";
            $mail->send();
            echo $user->showMessage('success','We have send you the reset link in your e-mail ID Account,
            Please check your e-mail!');

        }catch(PDOException $e){
            echo $user->showMessage('danger','Something went wrong please try again !');
        }

    }else{
        echo $user->showMessage('info','This E-mail does not register!');
    }
}

//Handler checking user still login
if(isset($_POST['action']) && $_POST['action'] == "checkLogged"){
    if(!$user->currentUser($_SESSION['user'])){
        echo 'bye';
        unset($_SESSION['user']);
    }
}



?>