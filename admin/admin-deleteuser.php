<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css"/>

<?php
    require_once 'package/admin-header.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-3 border-success rounded-0" >
            <div class="card-header bg-success text-white rounded-0">
                <h4 class="text-capitalize">total deleted user</h4>
            </div>
            <div class="card-body text-center">
               <div class="table-responsive" id="deleteAllDeleteUsers">
                <p>Please Wait...</p>


               </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        fetchAllUser();
    //Fetch all users ajax request
   function fetchAllUser(){
    $.ajax({
        url: "package/admin-action.php",
        method: "post",
        data: {action: "fetchAllDeletedUser"},
        success: function(response){
            $("#deleteAllDeleteUsers").html(response);
            $("table").DataTable({
                order: [0,'desc']
            });
        }
    });
   }

      //Restore Delete ajax user request 
      $("body").on('click','.restoreUserIcon',function(e){
        e.preventDefault();
        restore_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure, You want to restore ?',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!',
            background: "#0006"
            
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "package/admin-action.php",
                    method: "post",
                    data: {restore_id:restore_id},
                    success: function(response){
                    
                }
                })
                Swal.fire(
                'Restore!',
                'User has been restore.',
                'success',
                fetchAllUser()
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
