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

<div class="container">
   <div class="row justify-content-center">
      <div class="col-lg-8 m-4 border-primary">
         <?php if($verified == 'Verified!'): ?>
         <div class="card ">
            <h4 class="card card-header rounded-0 bg-primary text-center text-white">
               Send Feedback to Admin!
            </h4>
            <div class="card card-body border-primary rounded-0">
               <form action="" method="post" id="feedback-form">
                  <div class="form-group">
                     <input type="text" name="subject" id="subject" class="form-control rounded-0" placeholder="Write Your Subject" required style="font-family:cursive;">
                  </div>
                  <div class="form-group mt-2">
                     <textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control rounded-0" placeholder="Write Your Feedback Here..." required style="font-family:cursive;"></textarea>
                  </div>
                  <div class="from-group mt-2">
                     <input type="submit" name="feedbackBtn" id="feedbackBtn" class="btn btn-outline-primary w-100 rounded-0" value="Send Feedback">
                  </div>
               </form>
            </div>
         </div>
         <?php else: ?>
            <h1 class="text-center text-secondary mt-5 text-capitalize">
               Verified Your E-Mail first to send feedback to admin!
            </h1>
         <?php endif ?>
      </div>
   </div>
</div>


<!-- script tag  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
      // Send feedback to admin ajax request 
      $("#feedbackBtn").click(function(e){
         if($("#feedback-form")[0].checkValidity()){
            $(this).val("Please Wait");
            e.preventDefault();

            $.ajax({
               url: "component/process.php",
               method: "post",
               data: $("#feedback-form").serialize()+"&action=feedback",
               success: function(response){
                  $("#feedback-form")[0].reset();
                  $("#feedbackBtn").val("Send Feedback");

                  const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.addEventListener('mouseenter', Swal.stopTimer)
                     toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                  })

                  Toast.fire({
                  icon: 'success',
                  title: 'Feedback successfully'
                  })

               }
               
            });
         }
      });

      // Check notification 
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

   });
</script>

</body>
</html>