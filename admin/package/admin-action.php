<?php
    require_once 'admin-db.php';
    $admin = new Admin();
    session_start();

    //Handler admin ajax request 
    if(isset($_POST['action']) && $_POST['action'] == 'adminLogin'){
        $username = $admin->test_input($_POST['username']);
        $password = $admin->test_input($_POST['password']);
        $hpassword = sha1($password);
        $loginInAdmin = $admin->adminLogin($username, $hpassword);

        if($loginInAdmin!= null){
            echo 'admin_login';
            $_SESSION['username'] = $username;
        }else{
            echo $admin->showMessage('danger','Username or Password is Incorrect!');
        }
    }

    // Handler Fetchalluser form database ajax 
    if(isset($_POST['action']) && $_POST['action'] == "fetchAllUser"){
       $output = '';
       $data = $admin->fetchAllUser(0);
       if($data){
        $output.='
        <table class="table table-bordered text-center table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Verified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        ';
        foreach($data as $row){
            if($row['photo']!= ''){
                $photo = '../component/'.$row['photo'].'';
            }else{
                $photo = '../assets/img_avatar3.png';
            }

            $output.='
                    <tr>
                    <td>'.$row['id'].'</td>
                    <td><img src="'.$photo.'" class="rounded-circle w-25 h-27" ></td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['verified'].'</td>
                    <td class="justify-content-center">
                    <a href="#" id="'.$row['id'].'" title="View Details" class="mt-2 mx-1 text-primary userDetailIcon" data-bs-toggle="modal" data-bs-target="#showModalUserDetail"><i class="fas fa-info-circle"></i></a>
                    <a href="#" id="'.$row['id'].'" class="mt-2 px-1 text-danger deleteUserIcon" title="Delete User"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            '; 
        }
        $output.='
        </tbody>
        </table>
        ';
        echo $output;

        }else{
            echo '<h3> class="text-center text-secondary"  :) NO USER FOUND! </h3>';
        }
    }

    // Handler Display ajax request 
    if(isset($_POST['detail_id'])){
        $id = $_POST['detail_id'];
       $data = $admin->displayUser($id);
       echo json_encode($data);
    }

    // Handler delete ajax user 
    if(isset($_POST['del_id'])){
        $id = $_POST['del_id'];
        $admin->deleteUser($id,0);
    }

    //Handler select user deleted
    if(isset($_POST['action']) && $_POST['action'] == "fetchAllDeletedUser"){
        $output = '';
        $data = $admin->fetchAllUser(1);
        if($data){
         $output.='
         <table class="table table-bordered text-center table-striped">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Image</th>
                 <th>Name</th>
                 <th>E-Mail</th>
                 <th>Phone</th>
                 <th>Gender</th>
                 <th>Verified</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
         ';
         foreach($data as $row){
             if($row['photo']!= ''){
                 $photo = '../component/'.$row['photo'].'';
             }else{
                 $photo = '../assets/img_avatar3.png';
             }
 
             $output.='
                     <tr>
                     <td>'.$row['id'].'</td>
                     <td><img src="'.$photo.'" class="rounded-circle" style="width:70px; height: 70px; object-fit: cover;"></td>
                     <td>'.$row['name'].'</td>
                     <td>'.$row['email'].'</td>
                     <td>'.$row['phone'].'</td>
                     <td>'.$row['gender'].'</td>
                     <td>'.$row['verified'].'</td>
                     <td class="justify-content-center bg-white">
                     <a href="#" id="'.$row['id'].'" class="text-white restoreUserIcon text-decoration-none" title="Restore User"><span class="badge bg-danger">Restore</span></a>
                     </td>
                 </tr>
             '; 
         }
         $output.='
         </tbody>
         </table>
         ';
         echo $output;
 
         }else{
             echo '<h3 class="text-center text-secondary">  :( NO USER DELETED  ! </h3>';
         }
    }

    //Handler restore deleted user
    if(isset($_POST['restore_id'])){
        $id = $_POST['restore_id'];
        $data = $admin->deleteUser($id,1);

    }

    // Handler fetch user ajax 
    if(isset($_POST['action']) && $_POST['action'] == "fetchAllNote"){
        $output = '';
        $note = $admin->fetchAllNote();
        if($note){
         $output.='
         <table class="table table-bordered text-center table-striped">
         <thead>
             <tr>
                 <th>#</th>
                 <th>User Name</th>
                 <th>User E-Mail</th>
                 <th>Note Title</th>
                 <th>Note</th>
                 <th>Written On</th>
                 <th>Updated On</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
         ';
         foreach($note as $row){
 
             $output.='
                     <tr>
                     <td>'.$row['id'].'</td>
                     <td>'.$row['name'].'</td>
                     <td>'.$row['email'].'</td>
                     <td>'.$row['title'].'</td>
                     <td>'.$row['note'].'</td>
                     <td>'.$row['create_at'].'</td>
                     <td>'.$row['update_at'].'</td>
                     <td class="justify-content-center ">
                     <a href="#" id="'.$row['id'].'" class="text-danger deleteNoteIcon" title="Delet note"><i class="fas fa-trash-alt fa-lg"></i></a>
                     </td>
                 </tr>
             '; 
         }
         $output.='
         </tbody>
         </table>
         ';
         echo $output;
 
         }else{
             echo '<h3 class="text-center text-danger">  :( NO NOTE FOUND HERE ! </h3>';
         }
    }

    if(isset($_POST['note_id'])){
        $id = $_POST['note_id'];
        $admin->deleteNote($id);
    }

    //Handler Display all  feedback ajax 
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllFeedback'){
        $output = '';
        $feedbacks = $admin->fetchAllFeedback();
        if($feedbacks){
         $output.='
         <table class="table table-bordered text-center table-striped">
         <thead>
             <tr>
                 <th>FID</th>
                 <th>UID</th>
                 <th>User Name</th>
                 <th>User E-Mail</th>
                 <th>Subject</th>
                 <th>Feedback</th>
                 <th>Sent On</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
         ';
         foreach($feedbacks as $row){
 
             $output.='
                     <tr>
                     <td>'.$row['id'].'</td>
                     <td>'.$row['uid'].'</td>
                     <td>'.$row['name'].'</td>
                     <td>'.$row['email'].'</td>
                     <td>'.$row['subject'].'</td>
                     <td>'.$row['feedback'].'</td>
                     <td>'.$row['created_at'].'</td>
                     <td class="justify-content-center ">
                     <a href="#" fid="'.$row['id'].'" id="'.$row['uid'].'" class="text-primary replyFeedbackIcon" title="Reply Feedback" data-bs-toggle="modal" data-bs-target="#showReplyModal"><i class="fas fa-reply fa-lg"></i></a>
                     </td>
                 </tr>
             '; 
         }
         $output.='
         </tbody>
         </table>
         ';
         echo $output;
 
         }else{
             echo '<h3 class="text-center text-secondary">  :( NO FEEDBACK FOUND HERE ! </h3>';
         }
    }

    //Handler Send feedback to user 
    if(isset($_POST['message'])){
        $uid = $_POST['uid'];
        $fid = $_POST['fid'];
        $message = $admin->test_input($_POST['message']);
        $admin->sendFeedbackToUser($uid,$message);
        $admin->feedbackReplied($fid);

    }

    //Handler fetch all notification
    if(isset($_POST['action']) && $_POST['action'] == "fetchAllNotification"){

        $notifications = $admin->fetchAllNotification();
        $output = "";
        if($notifications){
            foreach($notifications as $row){
                $output .='
                    <div class="alert alert-dark" role="alert">
                    <div class="d-flex justify-content-between">
                    <span class="mb-0 lead">New Notification</span>
                    <button type="button" id="'.$row['id'].'" class="btn close delNotificationIcon" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <p>'.$row['message'].' by '.$row['name'].'</p>
                    <hr>
                    <div class="d-flex justify-content-between m-0">
                    <span><b>User E-Mail : </b>'.$row['email'].'</span>
                    <span>'.$admin->timeAgo($row['created_at']).'</span>
                    </div>
                    </div>
                ';
            }
            echo $output;
        }else{
            echo "<h5 class='text-secondary text-center'>No notification found</h5>";
        }
    }
    // Handler check notification 
    if(isset($_POST['action']) && $_POST['action'] == "checkNotification"){
        if($admin->fetchAllNotification()){
            echo '<i class="fas fa-circle fa-sm text-danger"></i>';
        }else{
            echo '';
        }
    }

    //Handler delete Notification 
    if(isset($_POST['del_id'])){
        $id = $_POST['del_id'];
        $admin->deleteNotification($id);
    }

    // Handler export user 
    if(isset($_GET['export']) && $_GET['export'] == "excel"){
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=users.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $data = $admin->exportUser();
        echo '<table border="1" align=center>';
        echo '<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Dob</th>
                <th>Created At</th>
                <th>Verified</th>
                <th>Deleted</th>
            </tr>
            ';
       
        foreach($data as  $row){
            echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['dob'].'</td>
                <td>'.$row['created_at'].'</td>
                <td>'.$row['verified'].'</td>
                <td>'.$row['deleted'].'</td>
            </tr>
        ';
        }
        echo '</table>';
        
    }


?>