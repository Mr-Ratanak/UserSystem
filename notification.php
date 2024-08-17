<?php
   require_once 'component/session.php';
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css">
    <!-- sweetalert 2 -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">  
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,600;1,400;1,500&family=Roboto+Slab:wght@100&display=swap');
      *{
         box-sizing: border-box;
         -moz-box-sizing: border-box;
         -webkit-box-sizing: border-box;
         margin: 0;
         padding: 0;
         font-family: 'Mavel Pro','Nunito', sans-serif;
      }


      @media screen and (max-width:1000px){
         .logo{
            display: none;
         }
        
      }
    </style>  

</head>
<body>
<?php include 'component/header.php'; ?>

<div class="container p-1 mt-2 ">
   <div class="row">
      <div class="col-lg-6 mx-auto" id="showAllNotification">
        
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

      //fetch all notification of an user
      fetchNotification();
      function fetchNotification(){
         $.ajax({
            url: 'component/process.php',
            method: 'post',
            data: {action: 'fetchNotification'},
            success: function(response){
               $('#showAllNotification').html(response); 
            }
         });
      }

      checkNotification();
      function checkNotification(){
         $.ajax({
            url: "component/process.php",
            method: "post",
            data: {action:"checkNotification"},
            success: function(response){
               $("#checkNotification").html(response);

            }
         });
      }

      $("body").on('click','.close',function(e){
         e.preventDefault();
         notification_id = $(this).attr("id");

         $.ajax({
            url: "component/process.php",
            method: "post",
            data: {notification_id:notification_id},
            success: function(response){
               console.log(response);
            }
         });
      });

   });
</script>

</body>
</html>