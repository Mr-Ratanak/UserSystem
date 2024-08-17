<?php
    require_once "component/auth.php";
    $user = new  Auth();
    $msg = '';

    if(isset($_GET['email']) && $_GET['token']){
        $email = $user->test_input($_GET['email']);
        $token = $user->test_input($_GET['token']);

        $auth_user = $user->reset_pass_auth($email,$token);
        if($auth_user!= null){
            if(isset($_POST['submit'])){
                $newpass = $_POST['pass'];
                $cnewpass = $_POST['cpass'];
                $hnewpass = password_hash($newpass,PASSWORD_DEFAULT);
                
                if($newpass == $cnewpass){
                    $user->update_pass_user($hnewpass,$email);
                    $msg = 'Password has been changed successfully! <br>
                    <a class="text-warning" href="index.php">Login Here!</a>
                    ';
                }else{
                    $msg = 'Password not match!';
                }
            }
        }else{
            header("location:index.php");
            exit();
        }
    }else{
        header("location:index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset|Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <!-- sweetalert 2 -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">    

</head>
<body>

<!-- section container start  -->
    <div class="container">
        <div class="row justify-content-center wrapper ">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow flex-row-reverse">
                    <div class="card rounded-left p-4">
                        <h1 class="text-center fw-bold text-primary">Enter New Password!</h1>
                        <hr class="my-3">
                        <form action="" method="post" autocomplete="on">
                            <div class="text-center m-2 text-primary"><?= $msg; ?></div>
                            
                            <div class="input-group input-group-lg form-group pt-2">
                                <span class="input-group-text round-0">
                                    <i class="fas fa-key fa-lg"></i>
                                </span> 
                                <input type="password" name="pass" class="form-control rounded-0" placeholder="Password" 
                                required minlength="5">
                            </div>
                            <div class="input-group input-group-lg form-group pt-2">
                                <span class="input-group-text round-0">
                                    <i class="fas fa-key fa-lg"></i>
                                </span> 
                                <input type="password" name="cpass" class="form-control rounded-0" placeholder="Confirm password" 
                                required minlength="5">
                            </div>
                          
                            <div class="form-group pt-2">
                                <input type="submit" value="Reset Password" name="submit" class="form-control btn btn-primary btn-lg btn-block myBtn" >
                            </div>
                        </form>
                    </div>
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center fw-bolder text-white">Reset Your Password Here!</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- section container end  -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>