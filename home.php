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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css"/>
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
   <div class="row">
      <div class="col-lg-12">
         <?php  
            if($verified == "Not Verified!"): ?>
            <div class="alert alert-danger alert-dismissible text-center mt-2 m-0" role="alert">
               <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
               <strong>Your E-mail is not verified! We've sent you an Email Verification link on your E-mail, Check & verify now!</strong>
            </div>
            <?php endif ?>
      </div>
      <h4 class="text-center text-primary p-2">Write your noting here!</h4>
   </div>
   <div class="card border-primary">
      <h5 class="card-header bg-primary d-flex justify-content-between">
           <span class="align-self-center text-white">All Note</span>
           <a href="" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addNoteModal" ><i class="fas fa-plus-circle fa-lg"></i> Add New Note</a>
      </h5>
      <div class="card-body">
         <div class="table-responsive" id="showNote">
            <div class="d-flex justify-content-center z-index-1">
               <div class="spinner-border text-danger m-0 p-0" role="status">
                  <span class="visually-hidden">Loading...</span>
               </div>
              
            </div>
         </div>
      </div>
   </div>

</div>
<!-- Start Add new modal  -->
<div class="modal fade" id="addNoteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-success">
        <h4 class="modal-title">Add New Noted</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" method="post" id="add-note-form" class="px-3" autocomplete="on">
            <div class="form-group">
               <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required autofocus>
            </div>
            <div class="form-group">
               <textarea name="note" cols="30" rows="5" class="form-control form-control-lg mt-2" placeholder="Write Your Note Here..." required></textarea>
            </div>
            <div class="form-group">
               <input type="submit" name="addBtn" id="addBtn" class="btn btn-success btn-lg w-100 d-block mt-2">
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <marquee class="text-danger" direction="right" width="100%" scrollamount="5" scrollamount="12">entrive your secure data</marquee>
        <marquee class="text-danger" direction="left" width="100%" scrollamount="5" scrollamount="12">input properly data!</marquee>
      </div>

    </div>
  </div>
</div>
<!-- End add new modal  -->

<!-- Start Edit new modal  -->
<div class="modal fade" id="editNoteModal" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-info">
        <h4 class="modal-title">Edit New Noted</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" method="post" id="edit-note-form" class="px-3">
         <input type="hidden" name="id" id="id">
            <div class="form-group">
               <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required autofocus>
            </div>
            <div class="form-group">
               <textarea name="note" id="note" cols="30" rows="5" class="form-control form-control-lg mt-2" placeholder="Write Your Note Here..." required></textarea>
            </div>
            <div class="form-group">
               <input type="submit" value="Update" name="editBtn" id="updateBtn" class=" text-white btn btn-info btn-lg w-100 d-block mt-3">
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <marquee class="text-danger" direction="right" width="100%" scrollamount="5" scrollamount="12">🔞</marquee>
        <marquee class="text-danger" direction="left" width="100%" scrollamount="5" scrollamount="12">🔞</marquee>
      </div>

    </div>
  </div>
</div>
<!-- End Edit new modal  -->


<!-- script tag  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){

      //Add new Note Ajax request
      $("#addBtn").click(function(e){
         if($("#add-note-form")[0].checkValidity()){
            e.preventDefault();
            $("#addBtn").val("Please Wait");

            $.ajax({
               url: "component/process.php",
               method: "post",
               cache: false,
               data: $("#add-note-form").serialize()+"&action=add_note",
               success: function(response){
                  $("#addBtn").val("Submit");
                  $("#add-note-form")[0].reset();
                  $("#addNoteModal").modal('hide');

                  const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.addEventListener('mouseenter', Swal.stopTimer)
                     toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                  })

                  Toast.fire({
                  icon: 'success',
                  title: 'Signed in successfully'
                  })
                  displayAllNote();
               }
            });
         }
      });

      displayAllNote();
      // Display all note 
      function displayAllNote(){
         $.ajax({
            url: "component/process.php",
            method: "post",
            data: { action: "display_notes"},
            success: function(response){
               $("#showNote").html(response);
               $("table").DataTable({
                  order:[0,'desc']
               });
            }
         });
      }
      // Edit Ajax request 
      $("body").on("click",".editBtn",function(e){
         e.preventDefault();
         get_id = $(this).attr("id");
         $.ajax({
            url: "component/process.php",
            method: "post",
            data:{get_id:get_id},
            success: function(response){
               data = JSON.parse(response);
               $("#id").val(data.id);
               $("#title").val(data.title);
               $("#note").val(data.note);
            }
         });
      });
      // Update Note ajax 
      $("#updateBtn").click(function(e){
         if($("#edit-note-form")[0].checkValidity()){
         e.preventDefault();

         $.ajax({
            url: "component/process.php",
            method: "post",
            // data: $("#edit-note-form").serialize()+"&action=update_note", for more style 
            data: { action: "update_note", id: $("#id").val(), title: $("#title").val(), note: $("#note").val()},
           
         }).done( function(response){
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-start',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'warning',
            title: 'Updated successfully'
            })
            $("#editNoteModal").modal("hide");
            $("#edit-note-form")[0].reset();
            displayAllNote();
         });
         }
      });
      // Delete Note ajax
      $("body").on("click",".delBtn",function(e){
         e.preventDefault();
         del_id = $(this).attr('id');
         
         Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!',
         background: "#66666fff"
         
         
         }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: "component/process.php",
               method: "post",
               data: {del_id:del_id},
               success: function(response){
                  tr.css("background:","red");
                  
               }
            })
            Swal.fire(
               'Deleted!',
               'Your file has been deleted.',
               'success',
               location.reload()
            )
         }
         })
      });
      // Show note ajax request 
      $("body").on("click",".infoBtn",function(e){
         e.preventDefault();
            info_id = $(this).attr('id');
            $.ajax({
               url: "component/process.php",
               method: "post",
               data: {info_id:info_id},
               success: function(response){
                  data = JSON.parse(response);

                  Swal.fire({
                  icon: 'question',
                  title: 'Note : ID ('+data.id+')',
                  background: "#fffff7",
                  html: 
                  '<b><u>Title </u> : </b> '+data.title+' <br>'+ 
                  '<b><u>Note </u> : </b> '+data.note+' <br><br>'+
                  '<b><u>Written on</u> : </b>'+data.create_at+' <br>'+
                  '<b><u>Updated on</u> : </b>'+data.update_at+' <br>',
                  footer: '<a href="https://studentstutorial.com/ajax/crud">Why should i show you?</a>'
                  })
               }
            });
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

      // check user still login or not 
      $.ajax({
         url: "component/action.php",
         method: "post",
         data: {action:"checkLogged"},
         success: function(response){
            if(response == "bye"){
               window.location.href = "index.php";
            }
         }
      });

   });
</script>

</body>
</html>
