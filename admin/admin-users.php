
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">   
    
    <?php
    require_once 'package/admin-header.php';
    ?>
    
<div class="row">
    <div class="col-lg-12">
        <div class="card my-3 border-success rounded-0" >
            <div class="card-header bg-success text-white rounded-0">
                <h4 class="text-capitalize">total registerd user</h4>
            </div>
            <div class="card-body text-center">
               <div class="table-responsive" id="fetchAllUsers">
                <p>Please Wait...</p>
    

               </div>
            </div>
        </div>
    </div>
</div>

<!-- Display modal Details  -->
<!-- The Modal -->

<div class="modal modal-lg" id="showModalUserDetail" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="getName"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="card border-0" >
        <div class="card-deck d-flex justify-content-between">
            <div class="card border-primary"  style="width: 49%;">
                <div class="card-body">
                    <p id="getEmail"></p>
                    <p id="getPhone"></p>
                    <p id="getDob"></p>
                    <p id="getGender"></p>
                    <p id="getCreated"></p>
                    <p id="getVerified"></p>
                </div>
            </div>
            <div class="card align-self-center" id="getImage"  style="width: 49%;"></div>
        </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script type="text/javascript"> 
    $(document).ready(function(){

    fetchAllUser();
    //Fetch all users ajax request
   function fetchAllUser(){
    $.ajax({
        url: "package/admin-action.php",
        method: "post",
        data: {action: "fetchAllUser"},
        success: function(response){
            $("#fetchAllUsers").html(response);
            $("table").DataTable({
                order: [0,'desc']
            });
        }
    });
   }
//    Display user in Details ajax request 
   $("body").on('click','.userDetailIcon',function(e){
       e.preventDefault();
       detail_id = $(this).attr('id');

       $.ajax({
        url: "package/admin-action.php",
        method: "post",
        data: {detail_id:detail_id},
        success: function(response){
            data = JSON.parse(response);
            $("#getName").text(data.name + "( ID: " + data.id +" )");
            $("#getEmail").text("E-Mail : " + data.email);
            $("#getPhone").text("Phone : " + data.phone);
            $("#getDob").text("DOB : " + data.dob);
            $("#getGender").text("Gender : " + data.gender);
            $("#getCreated").text("Joined On : " +data.created_at);
            $("#getVerified").text("Verified : " + data.verified);
            if(data.photo!= ''){
                $("#getImage").html('<img src="../component/'+data.photo+'" width="280px" class="img-thumbnail img-fluid align-self-center">');
            }else{
                $("#getImage").html('<img src="../assets/img_avatar5.png" class="img-thumbnail img-fluid align-self-center">');
            }

        }
       })

   });
   //Delete ajax user request 
   $("body").on('click','.deleteUserIcon',function(e){
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
                url: "package/admin-action.php",
                method: "post",
                data: {del_id:del_id},
                success: function(response){
                  tr.css("background:","red");
                  
               }
            })
            Swal.fire(
               'Deleted!',
               'User has been deleted.',
               'success',
               location.reload()
            )
         }
         })

   });
   checkNotification();
        // check Notification 
        function checkNotification(){
            $.ajax({
                url: "package/admin-action.php",
                type: "POST",
                data: {action: "checkNotification"},
                success: function(response){
                    $("#checkAlertNotification").html(response);
                }
            });
        }


    });
</script>
