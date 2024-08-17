<?php
    require_once 'config.php';

    class Admin extends Database{
        //Admin Login
        public function adminLogin($username,$password){
            $sql = $this->connect->prepare("SELECT * FROM admin WHERE username=? AND password= ?");
            $sql->execute([$username,$password]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        //Count all user
        public function totalCount($tablename){
            $sql = $this->connect->prepare("SELECT * FROM $tablename");
            $sql->execute();
            $row = $sql->rowCount();
            return $row;
        }

        //Count user verified
        public function countVerified($status){
            $sql = $this->connect->prepare("SELECT * FROM users WHERE verified= ?");
            $sql->execute([$status]);
            $row = $sql->rowCount();
            return $row;
        }

        //Gender percengtage
        public function genderPer(){
            $sql = $this->connect->prepare("SELECT gender, COUNT(*) AS number FROM users WHERE gender!= '' GROUP BY gender");
            $sql->execute();
            $gender = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $gender;
        }

        //User's Verify/Unverify Percentage
        public function verifiedPer(){
            $sql = ("SELECT verified, COUNT(*) AS number FROM users GROUP BY verified");
            // $sql = ("SELECT COUNT(verified) AS number FROM users GROUP BY verified");
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            $verified = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $verified;
        }
        
        //Website hit 
        public function visitor(){
            $sql = $this->connect->prepare("SELECT hits FROM visitors");
            $sql->execute();
            $visitor = $sql->fetch(PDO::FETCH_ASSOC);
            return $visitor;
        }

        //Fetch all user ajax request
        public function fetchAllUser($eval){
            $sql = $this->connect->prepare("SELECT * FROM users WHERE deleted!= $eval");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        // Display all user Details 
        public function displayUser($id){
            $sql = $this->connect->prepare("SELECT * FROM users WHERE id= ? AND deleted!= 0");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        // Delete user 
        public function deleteUser($id,$val){
            $sql = $this->connect->prepare("UPDATE users SET deleted= $val WHERE id= ?");
            $sql->execute([$id]);
            return $sql;
        }

        // fetch all note ajax request 
        public function fetchAllNote(){
            $sql = $this->connect->prepare("SELECT notes.id, notes.title, notes.note, notes.create_at,
            notes.update_at, users.name, users.email FROM notes INNER JOIN users ON notes.uid = users.id");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        // Delete note 
        public function deleteNote($id){
            $sql = $this->connect->prepare("DELETE FROM notes WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }

        // fetch all feedback 
        public function fetchAllFeedback(){
            $sql = $this->connect->prepare("SELECT feedbacks.id, feedbacks.uid, feedbacks.subject, feedbacks.feedback,
            feedbacks.created_at, users.name, users.email FROM feedbacks INNER JOIN users 
            ON feedbacks.uid = users.id WHERE replied!= 1");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // send feedback to user 
        public function sendFeedbackToUser($uid,$message){
            $sql = $this->connect->prepare("INSERT INTO notifications (uid,type,message) VALUES (?,'user',?)");
            $sql->execute([$uid,$message]);
            return true;
        }
        // Set feedback Replied 
        public function feedbackReplied($fid){
            $sql = $this->connect->prepare("UPDATE feedbacks SET replied=1 WHERE id= ?");
            $sql->execute([$fid]);
            return true;
        }

        //fetch all notification of an user
        public function fetchAllNotification(){
            $sql = $this->connect->prepare("SELECT notifications.id, notifications.message,
             notifications.created_at, users.name, users.email FROM notifications INNER JOIN users ON 
             notifications.uid = users.id WHERE type='admin' ORDER BY notifications.id DESC LIMIT 5 ");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        //Delete notification
        public function deleteNotification($id){
            $sql = $this->connect->prepare("DELETE FROM notifications WHERE id= ? AND type= 'admin' ");
            $sql->execute([$id]);
            return true;
        }

            // Export all user to excel 
        public function exportUser(){
            $sql = $this->connect->prepare("SELECT * FROM users");
            $sql->execute();
            $stmt = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        }



    }
?>