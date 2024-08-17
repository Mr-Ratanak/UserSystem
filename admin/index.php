<?php
   session_start();
    if(isset($_SESSION['username'])){
        header("location:admin-dashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css">
    <!-- sweetalert 2 -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">  
    <link rel="stylesheet" href="css/style.css">
    <title>Admin</title>

</head>
<body>
    
<div class="container h-100">
   <div class="row h-100 justify-content-center">
    <div class="col-lg-4 align-self-center ">
    <div class="card bg-danger m-0 p-0 rounded-0">
        <h4 class="card-header text-white p-1">
            &nbsp; <i class="fas fa-user-cog"></i> Admin Panel Login
        </h4>
    </div>
    <div class="card-body p-3 border border-danger shadow-lg">
        <div id="alertMessage"></div>
        <form class="form-horizontal" action="" method="post" id="admin-login-form">
            <div class="form-group ">
                <input type="text" name="username" id="username" class="form-control rounded-0" placeholder="Username" required>
            </div>
            <div class="form-group mt-2">
                <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" required>
            </div>
            <div class="form-group mt-2">
                <input type="submit" class="rounded-0 btn btn-danger text-white w-100" name="adminLoginBtn" id="adminLoginBtn" value="Login">
            </div>
        </form>

    </div>
    </div>
   </div>
</div>


<!-- script tag  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
       $("#adminLoginBtn").click(function(e){
        if($("#admin-login-form")[0].checkValidity()){
            e.preventDefault();
            $(this).val("Please Wait...");

            $.ajax({
                url: "package/admin-action.php",
                method: "post",
                data: $("#admin-login-form").serialize()+"&action=adminLogin",
                
            }).done(function(response){
                if(response === 'admin_login'){
                    window.location= "admin-dashboard.php";
                }else{
                    $("#alertMessage").html(response);
                }
                $("#adminLoginBtn").val("Login");
                $("#admin-login-form")[0].reset();
            });
        }

       });
    });
</script>
</body>
</html>