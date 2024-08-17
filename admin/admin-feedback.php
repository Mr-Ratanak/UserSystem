<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">   

<?php
    require_once 'package/admin-header.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-3 border-warning rounded-0" >
            <div class="card-header bg-warning text-white rounded-0">
                <h4 class="text-capitalize">total feedback from users</h4>
            </div>
            <div class="card-body text-center">
               <div class="table-responsive" id="fetchAllFeedback">
                <p>Please Wait...</p>

               </div>
            </div>
        </div>
    </div>
</div>

<!-- Reply Feedback Modal  -->
<div class="modal fade" id="showReplyModal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centerd">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reply This Feedback</h4>
                <button type="button" class="fas fa-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="feedback-reply-form">
                    <div class="form-group">
                        <textarea name="message" id="message" class="form-control" cols="30" rows="6" required placeholder="Write your message here..."></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary btn-block w-100" name="submit" id="feedbackReplyBtn" value="Send Reply">
                    </div>
                </form>
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

        fetchAllFeedback();
        //Display all feedback ajax request
        function fetchAllFeedback(){
            $.ajax({
                url: "package/admin-action.php",
                type: "POST",
                data: {action: "fetchAllFeedback"}
            }).done(function(response){
                $("#fetchAllFeedback").html(response);
                $("table").DataTable({
                    order: [0,'desc']
                });
            });
        }

        //Declear global variable
        var uid;
        var fid;
        $("body").on("click",".replyFeedbackIcon",function(){
            uid = $(this).attr("id");
            fid = $(this).attr("fid");
        // Send request ajax 
        $("body").on('click','#feedbackReplyBtn',function(e){
            if($("#feedback-reply-form")[0].checkValidity()){
                var message = $("#message").val();
                e.preventDefault();
                $("#feedbackReplyBtn").val("Please Wait...");

                $.ajax({
                    url: "package/admin-action.php",
                    method: "post",
                    data: {uid:uid, fid:fid, message:message}
                }).done(function(response){
                    $("#feedbackReplyBtn").val("Send Reply");
                    $("#feedback-reply-form")[0].reset();
                    // $("#showReplyModal").modal('hide');
                    fetchAllFeedback();

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
                    });

                    Toast.fire({
                    icon: 'success',
                    title: 'Reply successfully'
                    })

                });
            }

        });

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