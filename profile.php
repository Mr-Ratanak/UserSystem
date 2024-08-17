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
      *::selection{
         background-color: yellowgreen;
         color: white;
      }

      *::-webkit-scrollbar{
         height: .5rem;
         width: 1rem;
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
<!-- section profile start  -->
   <div class="container">
      <div class="row justify-content-center mt-3">
         <div class="col-lg-10">
            <div class="card rounded-0 card-header border-primary mb-1">
               <div class="card-header card-header-tabs bg-dark">
                  <ul class="nav nav-taps card-header-tabs">
                     <li class="nav-item pb-2">
                        <a href="#profile" data-toggle="tab" class="nav-link active fw-bold">Profile</a>
                     </li>
                     <li class="nav-item">
                        <a href="#editProfile" data-toggle="tab" class="nav-link fw-bold">Edit Profile</a>
                     </li>
                     <li class="nav-item">
                        <a href="#changePassword" data-toggle="tab" class="nav-link fw-bold">Change Password</a>
                     </li>
                  </ul>
               </div>
               <div class="card-body">
                  <div class="tab-content">
                     <!-- card profile  -->
                     <div class="tab-pane container active" id="profile">
                        <div id="verifyAlertEmail"></div>
                        <div class="card-deck d-flex justify-content-between">
                           <div class="card border-primary" style="width: 49%;">
                              <div class="card-header bg-primary text-light text-center lead">
                                 User ID : <?=$cid;?>
                              </div>
                              <div class="card-body">
                              <p style="border: 1px solid #0275d8;" class="card-text p-2 m-1">
                                 <b>Name :</b> <?=$cname?>
                              </p>
                              <p style="border: 1px solid #0275d8;" class="card-text p-2 m-1">
                                 <b>E-Mail :</b> <?=$cemail;?>
                              </p>
                              <p style="border: 1px solid #0275d8;" class="card-text p-2 m-1">
                                 <b>Gender :</b> <?=$cgender;?>
                              </p>
                              <p style="border: 1px solid #0275d8;" class="card-text p-2 m-1">
                                 <b>Date Of Birth :</b> <?=$cdob; ?>
                              </p>
                              <p style="border: 1px solid #0275d8;" class="card-text p-2 m-1">
                                 <b>Phone :</b> <?=$cphone;?>
                              </p>
                              <p style="border: 1px solid #0275d8;" class="card-text p-2 m-1">
                                 <b>Register On :</b> <?=$reg_on;?>
                              </p>
                              <p style="border: 1px solid #0275d8;" class="card-text p-2 m-1">
                                 <b>E-Mail Verify :</b> <?=$verified;?>
                                 <?php if($verified === "Not Verified!"): ?>
                                    <a href="#" style="float: right;" id="verified-email">Verify Now</a>
                                 <?php endif ?>
                              </p>
                              </div>
                           </div>
                           <div class="card border-primary border border-2" style="width: 49%;">
                                 <?php if(!$cphoto): ?>
                                    <img class="img-thumbnail img-fluid w-100" src="assets/img_avatar3.png" alt="image">
                                    <?php else: ?>
                                    <img class="img-thumbnail img-fluid" style="width: 100%; height: 420px;" src="component/<?= $cphoto; ?>" alt="image">
                                 <?php endif ?>

                           </div>
                        </div>
                     </div>
                     
                     <!-- card editProfile  -->
                     <div class="tab-pane container fade" id="editProfile">
                        <div class="card-deck d-flex justify-content-between">
                           <div class="card border-warning border border-2 align-self-center" style="width: 49%;">
                              <?php if(!$cphoto): ?>
                                 <img class="img-fluid w-100" src="assets/img_avatar3.png" alt="image">
                                 <?php else: ?>
                                 <img class=" img-fluid w-100" src="component/<?= $cphoto; ?>" alt="image">
                                 
                              <?php endif ?>
                           </div>
                           <div class="card border-warning border border-2 p-2" style="width: 49%;">
                              <form action="" method="post" enctype="multipart/form-data" id="profile-update-form">
                              <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">   
                              <div class="form-group">
                                 <label for="editimage" class="form-label">Upload Profile Image</label>
                                 <input type="file" name="image" id="editimage" class="form-control">
                              </div>
                              <div class="form-group m-1">
                                 <label for="editname" class="form-label">Enter name</label>
                                 <input type="text" name="name" id="editname" value="<?= $cname; ?>" class="form-control" placeholder="Ron Ratanak" title="Name">
                              </div>
                              <div class="form-group m-1">
                                 <label for="editgender" class="form-label">Enter gender</label>
                                 <select name="gender" id="editgender" class="form-control" title="Gender">
                                    <option value="" disabled <?php if($cgender == null){echo 'selected'; } ?>>
                                    Selected</option>
                                    <option value="Male" <?php if($cgender == "Male"){echo 'selected'; } ?>>Male</option>
                                    <option value="Female" <?php if($cgender == "Female"){echo 'selected'; } ?>>Female</option>
                                    </select>
                              </div>
                              <div class="form-group m-1">
                                 <label for="editdob" class="form-label">Date Of Birth</label>
                                 <input type="date" name="dob" id="editdob" value="<?= $cdob; ?>" class="form-control" placeholder="Date of birth" title="Date of birth">
                              </div>
                              <div class="form-group m-1">
                                 <label for="editphone" class="form-label">Phone</label>
                                 <input type="tel" name="phone" id="editphone" value="<?= $cphone; ?>" class="form-control" placeholder="Phone" title="Phone">
                              </div>
                              <div class="form-group m-2">
                                 <input type="submit" name="profile_update" value="Update Profile" class="btn btn-danger">
                              </div>

                              </form>
                           </div>
                        </div>
                     </div>

                     <!-- card changePassword  -->
                     <div class="tab-pane container fade" id="changePassword">
                        <div id="checkPassAlert" class="text-center"></div>

                        <div class="card-deck d-flex justify-content-between">
                           <div class="card border-success pb-2" style="width: 50%;">
                              <div class="card-header bg-secondary text-center text-white lead">
                                 Change Password
                              </div>
                              <form action="" method="post" class="px-3 mt-2" id="change-pass-form">
                                 <div class="form-group">
                                    <label for="curPass" class="form-label">Enter your current password</label>
                                    <input type="password" name="curPass" id="curPass" class="form-control" placeholder="Current Password" required >
                                 </div> 
                                 <div class="form-group p-1">
                                    <label for="newPass" class="form-label">Enter New Password <span class="text-danger">*</span></label>
                                    <input type="password" name="newPass" id="newPass" class="form-control" placeholder="New Password" required minlength="3">
                                 </div> 
                                 <div class="form-group p-1">
                                    <label for="conPass" class="form-label">Enter Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" name="cnewPass" id="cnewPass" class="form-control" placeholder="Confirm Password" required minlength="3">
                                 </div> 
                                 <div class="form-group">
                                    <p id="checkErrorPassword" class="text-danger"></p>
                                 </div>
                                 <div class="form-group p-2">
                                    <input type="submit" name="change_pass" id="changePassBtn" class="btn btn-success btn-md" value="Change Password">
                                 </div>
                              </form>
                           </div>
                           <div class="card border-success border border-1 align-self-center" style="width: 50%;">
                              <div class="card-header" >
                                 <img src="assets/680-it-developer-lineal.png" alt="image" class="img-fluid w-100">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<!-- section profile end  -->

<!-- section eidtProfile start -->
                                   
<!-- section eidtProfile end -->




<!-- script tag  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
      //profile update form 
      $("#profile-update-form").submit(function(e){
         e.preventDefault();
         $.ajax({
            url: "component/process.php",
            method: "post",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response){
               location.reload();
            }
         });
      });

      // Change password ajax request 
      $("#changePassBtn").click(function(e){
         if($("#change-pass-form")[0].checkValidity()){
            e.preventDefault();
            $("#changePassBtn").val("Please Wait");

            if($("#newPass").val() != $("#cnewPass").val()){
               $("#checkErrorPassword").text("* Password did not match!");
               $("#changePassBtn").val("Update Password");

            }else{
               $.ajax({
                  url: "component/process.php",
                  method: "post",
                  cache: false,
                  data: $("#change-pass-form").serialize()+"&action=change_pass",
                  success: function(response){
                     $("#changePassBtn").val("Update Password");
                     $("#checkPassAlert").html(response);
                     $("#change-pass-form")[0].reset();
                     $("#checkErrorPassword").text("");
                  }

               });
            }
         }
         
      });
      // Verify email ajax requesst 
      $("#verified-email").click(function(e){
         e.preventDefault();
         $(this).text("Please Wait");

         $.ajax({
            url: "component/process.php",
            method: "post",
            data:{action:"verify_email"},
            success: function(response){
               $("#verifyAlertEmail").html(response);
               $("#verified-email").text("Verify Now");
            }
         });
      });

      // Check Notification 
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