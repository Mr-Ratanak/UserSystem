<?php
require_once ("config.php");

class Auth extends Database{
    // Register for new user 
    public function register($name,$email,$password){
        $sql = $this->connect->prepare("INSERT INTO users (name,email,password) VALUES(?,?,?)");
        $sql->execute([$name,$email,$password]);
        return true;
    }

    // Check for already user register 
    public function user_exist($email){
        $sql = $this->connect->prepare("SELECT * FROM users WHERE email= ?");
        $sql->execute([$email]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Login Existing user 
    public function login($email){
        $sql = $this->connect->prepare("SELECT email, password FROM users WHERE email= ? AND deleted != 0");
        $sql->execute([$email]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // Current user in Session 
    public function currentUser($email){
        $stmt = $this->connect->prepare("SELECT * FROM users WHERE email =? AND deleted!= 0");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // Forgot passwor 
    public function forgot_password($token,$email){
        $sql = $this->connect->prepare("UPDATE users SET 
        token= ?, token_exspire = DATE_ADD(NOW(),INTERVAL 10 MINUTE) WHERE email= ?");
        $sql->execute([$token,$email]);
        return true;
    }

    // Reset password Authenication 
    public function reset_pass_auth($email,$token){
        $sql = $this->connect->prepare("SELECT id FROM users WHERE email= ? AND token= ? AND token!= '' 
        AND token_exspire > NOW() AND deleted!= 0");
        $sql->execute([$email,$token]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // Update password user 
    public function update_pass_user($pass,$email){
        $sql = $this->connect->prepare("UPDATE users SET token= '', password= ? WHERE email= ? AND deleted!= 0");
        $sql->execute([$pass,$email]);
        return true;
    }

    // Add new note 
    public function add_new_note($uid,$title,$note){
        $sql = $this->connect->prepare("INSERT INTO notes (uid,title,note) VALUES(?,?,?)");
        $sql->execute([$uid,$title,$note]);
        return true;
    }
    // Show all note 
    public function get_all_notes($uid){
        $sql = $this->connect->prepare("SELECT * FROM notes WHERE uid= ?");
        $sql->execute([$uid]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // Edit note 
    public function edit_note($id){
        $sql = $this->connect->prepare("SELECT * FROM notes WHERE id= ?");
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // Update note
    public function update_note($id,$title,$note){
        $sql = $this->connect->prepare("UPDATE notes SET title= ?, note= ?, update_at=NOW() WHERE id= ?");
        $sql->execute([$title,$note,$id]);
        return true;
    }
    // Delete note 
    public function delete_note($id){
        $sql = $this->connect->prepare("DELETE FROM notes WHERE id= ?");
        $sql->execute([$id]);
        return true;
    }

    // update profile 
    public function update_profile($name,$gender,$dob,$phone,$photo,$id){
        $sql = $this->connect->prepare("UPDATE users SET name=? ,gender=? ,dob=?, phone=? ,photo= ? WHERE id= ? AND deleted!= 0");
        $sql->execute([$name,$gender,$dob,$phone,$photo,$id]);
        return true;
    }
  
    // update password 
    public function update_password($new_pass,$id){
        $sql = $this->connect->prepare("UPDATE users SET password=? WHERE id=? AND deleted!=0");
        $sql->execute([$new_pass,$id]);
        return true;
    }

    // Verify email 
    public function verify_email($email){
        $sql = $this->connect->prepare("UPDATE users SET verified = 1 WHERE email= ? AND deleted!= 0");
        $sql->execute([$email]);
        return true;
    }

    // Send feedback 
    public function send_feedback($subject,$feedback,$uid){
        // $sql = $this->connect->prepare("INSERT INTO feedbacks (uid,subject,feedback) VALUES (?,?,?)");
        // $sql->execute([$uid,$subject,$feedback]);
        $sql = "INSERT INTO feedbacks (uid,subject,feedback)
         VALUES(:uid, :subject, :feedback)";
         $stmt = $this->connect->prepare($sql);
         $stmt->execute(['uid'=>$uid,'subject'=>$subject,'feedback'=>$feedback]);
        return true;
    }

    // Send notification 
    public function notification($uid,$type,$message){
        $sql = $this->connect->prepare("INSERT INTO notifications (uid,type,message) VALUES (?,?,?)");
        $sql->execute([$uid,$type,$message]);
        return true;
    }

    // Fetch Notification 
    public function fetchNotification($uid){
        $sql = $this->connect->prepare("SELECT * FROM notifications WHERE uid =? AND type= 'user' ");
        $sql->execute([$uid]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Remove notification 
    function removeNotification($id){
        $sql = $this->connect->prepare("DELETE FROM notifications WHERE id =? AND type= 'user' ");
        $sql->execute([$id]);
        return true;
    }


}

?>