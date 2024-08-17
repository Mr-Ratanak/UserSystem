<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:index.php");
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
    <?php
    $title = basename($_SERVER['PHP_SELF'],'.php');
    $title = explode('-',$title);
    $title = ucfirst($title[1]);

    ?>
    <title><?=$title?>| Admin Panel</title>
    <style>
        .admin-nav{
            width: 250px;
            height: 100vh;
            min-height: 100vh;
            overflow: hidden;
            background-color: #343a40;
            transition: 0.3s all ease-in-out;
            position: sticky;
            top: 0;
            left: 0;
        }
        .admin-link{
            background-color: #343a40;
        }
        .admin-link:hover, .nav-active{
            background-color: #212529;
            text-decoration: none;
        }
        .animate{
            width: 0;
            transition: all 0.3s ease-in-out;
        }
        
        @media(max-width: 540px){
            .admin-nav{
            width: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: #343a40;
            transition: 0.3s all ease-in-out;
            position: sticky;
            top: 0;
            left: 0;
        }
 

        }

    </style>
   
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="admin-nav p-0">
            <div class="text-light text-center p-2 fs-5" style="pointer-events: none; user-select: none;"> Admin Panel </div>
            
            <div class="list-group list-group-flush">
                <a href="admin-dashboard.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php')?"nav-active":""; ?>"><i class="fas fa-chart-pie"></i> &nbsp;  Dashboard</a>
                <a href="admin-users.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-users.php')?"nav-active":""; ?>"><i class="fas fa-user-friends"></i> &nbsp;  Users</a>
                <a href="admin-notes.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-notes.php')?"nav-active":""; ?>"><i class="fas fa-sticky-note"></i> &nbsp;  Notes</a>
                <a href="admin-feedback.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-feedback.php')?"nav-active":""; ?>"><i class="fas fa-comment"></i> &nbsp;  Feedback</a> 
                <a href="admin-notification.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-notification.php')?"nav-active":""; ?>"><i class="fas fa-bell"></i> &nbsp;  Notification&nbsp; <span id="checkAlertNotification"></span></a>
                <a href="admin-deleteuser.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-deleteuser.php')?"nav-active":""; ?>"><i class="fas fa-user-slash"></i> &nbsp; Deleted User</a>
                <a href="package/admin-action.php?export=excel" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-export.php')?"nav-active":""; ?>"><i class="fas fa-table"></i> &nbsp; Export User</a>
                <a href="admin-profile.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-profile.php')?"nav-active":""; ?>"><i class="fas fa-id-card"></i> &nbsp; Profile</a>
                <a href="admin-setting.php" class="list-group-item text-light admin-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-setting.php')?"nav-active":""; ?>"><i class="fas fa-cog"></i> &nbsp; Setting</a>

            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="pt-1 col-lg-12 bg-primary d-flex justify-content-between">
                    <!-- <a href="#" id="open-nav"><h3 class="text-white"><i class="fas fa-bars"></i></h3></a> -->
                    <div id="open-nav" style="cursor: pointer;"><h3 class="text-white"><i class="fas fa-bars"></i></h3></div>
                    <h4 class="text-white"><?= $title; ?></h4>
                    <a onclick="return(confirm('Are you sure you want to logout!'));" href="package/logout.php" class="text-light text-decoration-none mt-1">
                        <i class="fas fa-sign-out-alt"></i> &nbsp; Logout
                    </a>
                </div>
            </div>
           


            <!-- script tag  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
           $("#open-nav").click(function(){
            $(".admin-nav").toggleClass("animate");
           });
        });
</script>
</body>
</html>