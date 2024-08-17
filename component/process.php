<?php
require_once 'session.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);


// Handler Add new note 
if(isset($_POST['action']) && $_POST['action'] == "add_note"){
   $title = $cuser->test_input($_POST['title']);
   $note = $cuser->test_input($_POST['note']);

   $cuser->add_new_note($cid,$title,$note);
   $cuser->notification($cid,"admin","Note added");
}

// Handler display all note 
if(isset($_POST['action']) && $_POST['action'] == "display_notes"){
    $output = '';
    $notes = $cuser->get_all_notes($cid);

    if($notes){
        $output .= '
        <table class="table table-bordered table-striped bordered-danger">
        <thead>
           <tr>
           <th>#</th>
           <th>Title</th>
           <th>Note/Definition</th>
           <th>Action</th>
           </tr>
        </thead>
        <tbody>
        ';
        foreach($notes as $row){
            $output .='
            <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['title'].'</td>
            <td>'.substr($row['note'],0,80).'...</td>
            <td>
               <a href="#" id="'.$row['id'].'" title="detail" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i></a>
               <a href="#" id="'.$row['id'].'" title="Edit" data-bs-toggle="modal" data-bs-target="#editNoteModal" class="text-primary editBtn"><i class="fas fa-edit fa-lg"></i></a>
               <a href="#" id="'.$row['id'].'" title="Delete" class="text-danger delBtn"><i class="fas fa-trash-alt"></i></a>
            </td>
         </tr>
            ';
        }
        $output.= '
        </tbody>
        </table>
        ';
        echo $output;
        
    }else{
        echo '<h3 class="text-center text-secondary">:( You have not written any note yet! Write your first note now!</h3>';
    }

}

// Handler Edit note 
if(isset($_POST['get_id'])){
    $id = $_POST['get_id'];
    $row = $cuser->edit_note($id);
    echo json_encode($row);
}

// Handler update note 
if(isset($_POST['action'])  && $_POST['action'] == "update_note"){
    $id = $cuser->test_input($_POST['id']);
    $title = $cuser->test_input($_POST['title']);
    $note = $cuser->test_input($_POST['note']);
    $cuser->update_note($id,$title,$note);
    $cuser->notification($cid,"admin","Note updated");

}

// Handler delete note
if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];
    $cuser->delete_note($id);
    $cuser->notification($cid,"admin","Note deleted");
}

// Handler show info note 
if(isset($_POST['info_id'])){
    $id = $_POST['info_id'];
    $row = $cuser->edit_note($id);

    echo json_encode($row);
}

// Handler Profile edit ajax request 
if(isset($_FILES['image'])){
   $name = $cuser->test_input($_POST['name']);
   $gender = $cuser->test_input($_POST['gender']);
   $dob = $cuser->test_input($_POST['dob']);
   $phone = $cuser->test_input($_POST['phone']);
   
   $oldImage = $_POST['oldimage'];
   $folder = 'uploaded/';

   if(isset($_FILES['image']['name']) && ($_FILES['image']['name']!='')){

        $newImage = $folder.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
        // more style 
        // $newImage = $_FILES['image']['tmp_name'];
        // move_uploaded_file($folder,$newImage);

        if($oldImage!= null){
            unlink($oldImage);
        }
   }else{
    $newImage = $oldImage;
   }
   $cuser->update_profile($name,$gender,$dob,$phone,$newImage,$cid);
   $cuser->notification($cid,"admin","Profile updated");

}

// Handler change password ajax 
if(isset($_POST['action']) && $_POST['action'] == "change_pass"){
    $currentPass = $_POST['curPass'];
    $newPass = $_POST['newPass'];
    $cnewPass = $_POST['cnewPass'];
    $hNewPass = password_hash($newPass,PASSWORD_DEFAULT);

    if($newPass!= $cnewPass){
        echo $cuser->showMessage("danger","Password did not match!");
    }else{
        if(password_verify($currentPass,$cpass)){
        $cuser->update_password($hNewPass,$cid);
        echo $cuser->showMessage("success","Password has been changed!");
        $cuser->notification($cid,"admin","Password changed");
        }else{
            echo $cuser->showMessage("danger","Current password was wrong!");
        }
    }
}

// Handler verify email ajax 
if(isset($_POST['action']) && $_POST['action'] == "verify_email"){
    try{
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = Database::USERNAME;         
        $mail->Password   = Database::PASSWORD;                       
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;      
        
        $mail->setFrom(Database::USERNAME,'PNakCoding');
        $mail->addAddress($cemail);

        $mail->isHTML(true);
        $mail->Subject = "E-Mail Verification";
        $mail->Body = "
        <h3>
        Click the below link to verify your E-Mail.<br>
        <a href='http://localhost:7070/cookies/userSystem/verify-email.php?email=".$cemail." '>
        http://localhost:7070/cookies/userSystem/verify-email.php?email=".$cemail."
        </a>
        <br>Best regards Admin Mr.RatanakDevelopment!
        </h3>
        ";
        $mail->send();
        echo $cuser->showMessage('success','Verification link sent to your E-Mail.
        Please checked it up!');

    }catch(PDOException $e){
        echo $cuser->showMessage('danger','Something went wrong please try again !');
    }
}

// Handler send feedback to admin ajax request 
if(isset($_POST['action']) && $_POST['action'] == "feedback"){
    $subject = $cuser->test_input($_POST['subject']);
    $feedback = $cuser->test_input($_POST['feedback']);
    $cuser->send_feedback($subject,$feedback,$cid);
    $cuser->notification($cid,"admin","Feedback written");
}

// Handler Fetch notification 
if(isset($_POST['action']) && $_POST['action'] == "fetchNotification"){
    $notification = $cuser->fetchNotification($cid);
    $output = "";
    if($notification){
        foreach($notification as $row){
            $output .='
                <div class="alert alert-danger" role="alert">
                <div class="d-flex justify-content-between">
                <span class="mb-0 lead">New Notification</span>
                <button type="button" id="'.$row['id'].'" class="btn close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <p>'.$row['message'].'</p>
                <hr>
                <div class="d-flex justify-content-between m-0">
                <span>Reply of feedback from Admin</span>
                <span>'.$cuser->timeAgo($row['created_at']).'</span>
                </div>
                </div>
            ';
        }
        echo $output;
    }else{
        echo "<h4 class='text-secondary text-center'>No notification found</h4>";
    }
    
}

  // CheckNotification      
if(isset($_POST['action']) && $_POST['action'] == "checkNotification"){
    if($cuser->fetchNotification($cid)){
    echo '<i class="fas fa-circle fa-sm text-danger"> </i>';
    }else{
        echo '';
    }
}

// Remove notification 
if(isset($_POST['notification_id'])){
    $id = $_POST['notification_id'];
    $cuser->removeNotification($id);

}


?>