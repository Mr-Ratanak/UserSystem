<?php
    require_once 'component/session.php';
    
    if(isset($_GET['email'])){
        $email = $_GET['email'];
        $cuser->verify_email($email);
        header("location:profile.php");
    }else{
        header("location:index.php");
        exit();
    }

?>