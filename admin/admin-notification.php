<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">   

<?php
    require_once 'package/admin-header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-3 border-success rounded-0" >
            <div class="card-header bg-dark text-white rounded-0">
                <h4 class="text-capitalize">total notification</h4>
            </div>
            <div class="card-body text-center">
               <div class="table-responsive" id="showAllNotification">
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
        
        fetchAllNotification();
        //fetch all notification of an user
        function fetchAllNotification(){
            $.ajax({
                url: "package/admin-action.php",
                type: "POST",
                data: {action: "fetchAllNotification"},
                success: function(response){
                    $("#showAllNotification").html(response);
                }
            });
        }

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

        //Delete Notification
        $("body").on('click','.delNotificationIcon',function(e){
            e.preventDefault();
            del_id = $(this).attr('id');
            
            $.ajax({
                url: "package/admin-action.php",
                type: "POST",
                data: {del_id:del_id},
                success: function(response){
                    fetchAllNotification();
                    checkNotification();
                }
            });
        });

    });
</script>