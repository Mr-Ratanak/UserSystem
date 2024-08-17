<?php
    session_start();
    if(isset($_SESSION['user'])){
        header("location:home.php");
    }
    //website hit
    include_once 'component/config.php';
    $db = new Database();
    $sql = $db->connect->prepare("UPDATE visitors SET hits = hits+1 WHERE id= 0");
    $sql->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <!-- sweetalert 2 -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">    

</head>
<body>

<!-- section container start  -->
    <div class="container">
        <div class="row justify-content-center wrapper" id="login-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card rounded-left p-4">
                        <h1 class="text-center fw-bold text-primary">Sign in to Account</h1>
                        <hr class="my-3">
                        <form action="" method="post" id="login-form" autocomplete="on">
                            <div id="loginAlert"></div>
                            <div class="input-group input-group-lg form-group">
                                <span class="input-group-text round-0">
                                    <i class="far fa-envelope fa-lg"></i>
                                </span> 
                                <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-mail"
                                required value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email']; } ?>">
                            </div>
                            <div class="input-group input-group-lg form-group pt-2">
                                <span class="input-group-text round-0">
                                    <i class="fas fa-key fa-lg"></i>
                                </span> 
                                <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" 
                                required value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password']; } ?>" >
                            </div>
                            <div class="form-group pt-2 d-flex justify-content-between">
                                <div class="custom-control custom-checkbox float-left">
                                    <input type="checkbox" class="custom-control-input " name="rem" id="customCheck" 
                                    value="<?php if(isset($_COOKIE['email'])){?> checked <?php } ?> ">
                                    <label for="customCheck" class="custom-control-label px-1">Remember me</label>
                                </div>
                                <div class="forgot float-right">
                                <a href="#" id="forgot-link">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="form-group pt-2">
                                <input type="submit" value="Sign in" id="login-btn" class="form-control btn btn-primary btn-lg btn-block myBtn" >
                            </div>
                        </form>
                    </div>
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center fw-bold text-dark">Hello Friends</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center fw-border text-light-lead">Ener your personal data.....</p>
                        <button class="btn btn-outline-light btn-lg align align-self-center fw-border mt-4 myLinkBtn" id="register-link">Sign Up</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- section container end  -->

<!-- section register start  -->
    <div class="container ">
            <div class="row justify-content-center wrapper" style="display: none;" id="register-box">
                <div class="col-lg-10 my-auto">
                    <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-right myColor p-4">
                            <h1 class="text-center fw-bold text-dark">Welcome back!😉</h1>
                            <hr class="my-3 bg-light myHr">
                            <p class="text-center fw-border text-light-lead">To keep connected with us, Please login with your personal infomation.</p>
                            <button class="btn btn-outline-light btn-lg align align-self-center fw-border mt-4 myLinkBtn" id="login-link">Sign In</button>
                        </div>
                        <div class="card rounded-left p-4">
                            <h1 class="text-center fw-bold text-primary">Create an Account</h1>
                            <hr class="my-3">
                            <form action="" method="post" id="register-form" autocomplete="on">
                                <div id="regError"></div>
                                <div class="input-group input-group-lg form-group">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-user fa-lg"></i>
                                    </span> 
                                    <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required>
                                    <div class="invalid-feedback">Name is required!</div>
                                </div>
                                <div class="input-group input-group-lg form-group pt-2">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span> 
                                    <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-mail" required>
                                    <div class="invalid-feedback">E-mail is required!</div>
                                </div>
                                <div class="input-group input-group-lg form-group pt-2">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span> 
                                    <input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="Password" minlength="5" required>
                                    <div class="invalid-feedback">Password is required!</div>
                                </div>
                                <div class="input-group input-group-lg form-group pt-2">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span> 
                                    <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" required>
                                    <div class="invalid-feedback">Comfirm password is required!</div>
                                </div>
                                <div class="form-group pt-1">
                                    <div class="text-danger fw-bold" id="passError"></div>
                                </div>
                            
                                <div class="form-group pt-3">
                                    <input type="submit" value="Sign Up" class="form-control btn btn-primary btn-lg btn-block myBtn" id="register-btn" >
                                </div>
                            </form>
                        </div>
                    
                    </div>
                </div>

            </div>
    </div>
<!-- section register end  -->

<!-- section forgot start  -->
<div class="container ">
        <div class="row justify-content-center wrapper" style="display: none;" id="forgot-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center fw-bold text-dark">Reset Password</h1>
                        <hr class="my-3 bg-light myHr">
                        <button class="btn btn-outline-light btn-lg align align-self-center fw-border mt-4 myLinkBtn" id="back-link">Back</button>
                    </div>
                    <div class="card rounded-left p-4">
                        <h1 class="text-center fw-bold text-primary">Forgot Your Password</h1>
                        <hr class="my-3">
                        <p class="text-center fw-bold text-dark">To reset your password, enter the registerd email address and we will send you the
                            instructions on your email!🤳</p>
                        <form action="" method="post" id="forgot-form" autocomplete="on">
                            <div id="forgotAlert"></div>
                            <div class="input-group input-group-lg form-group">
                                <span class="input-group-text round-0">
                                    <i class="far fa-envelope fa-lg"></i>
                                </span> 
                                <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-mail" required>
                            </div>
                           
                          
                            <div class="form-group pt-2">
                                <input type="submit" value="Reset Password" class="form-control btn btn-primary btn-lg btn-block myBtn" id="forgot-btn" >
                            </div>
                        </form>
                    </div>
                  
                </div>
            </div>

        </div>
</div>
<!-- section forgot end  -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- script function -->
<!-- sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


<script>
    $(document).ready(function(){
        $("#register-link").click(function(){
            $("#login-box").fadeOut();
            $("#register-box").slideDown();
        });
        $("#login-link").click(function(){
            $("#register-box").slideUp();
            $("#login-box").fadeIn();
        });
        $("#forgot-link").click(function(){
            $("#login-box").fadeOut();
            $("#forgot-box").slideDown();
        });
        $("#forgot-link").click(function(){
            $("#login-box").fadeOut();
            $("#back-link").fadeIn();
        });
        $("#back-link").click(function(){
            $("#forgot-box").fadeOut();
            $("#login-box").show();
        });


        // Register form start 
    $("#register-btn").click(function(e){
        if($("#register-form")[0].checkValidity()){
            e.preventDefault();
            $("#register-btn").val("Please Wait...");
            if($("#rpassword").val() != $("#cpassword").val()){
                $("#passError").text("* Password did not matched!!!");
                $("#register-btn").val("Sign Up");
            }else{
                $("#passError").text("");
                $.ajax({
                    url: "component/action.php",
                    method: "post",
                    data: $("#register-form").serialize()+"&action=register",
                    success: function(response){
                        $("#register-btn").val("Sign Up");
                        if(response === 'register'){
                            window.location= "home.php";
                        }else{
                            $("#regError").html(response);
                        }
                    }
            });
            }
        }
    });
    // Login ajax request 
    $("#login-btn").click(function(e){
        if($("#login-form")[0].checkValidity()){
            e.preventDefault();
            $("#login-btn").val("Please Wait...");

            $.ajax({
               url: "component/action.php",
               method: "post",
               data: $("#login-form").serialize()+"&action=login",
               success: function(response){
                $("#login-btn").val("Sign In");
                if(response === 'login'){
                    window.location = "home.php";
                }else{
                    $("#loginAlert").html(response);
                }
               }
            });
        }
    });

    // Forgot password Ajax 
    $("#forgot-btn").click(function(e){
        if($("#forgot-form")[0].checkValidity()){
            e.preventDefault();
            $("#forgot-btn").val("Please Wait...");

            $.ajax({
                url: "component/action.php",
                method: "post",
                data: $("#forgot-form").serialize()+"&action=forgot",
                success: function(response){
                    $("#forgot-btn").val("Reset Password");
                    $("#forgot-form")[0].reset();
                    $("#forgotAlert").html(response);
                }
            });
        }
    });


    });
</script>

</body>
</html>