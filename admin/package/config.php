<?php
   class Database{
   const USERNAME = "ron.ratanakptm@gmail.com";
   const PASSWORD = "cnzjqgrwewkxsnuj";

    private $dsn= "mysql:host=localhost;dbname=db_user_system";
    private $username= "root";
    private $password = "";

    public $connect;
    public function __construct(){
      try{
         $this->connect = new PDO($this->dsn,$this->username,$this->password);
         // echo 'success';
       }catch(PDOException $e){
         echo "Error : ".$e->getMessage();
       }
       return $this->connect;
   }

   // Check  input 
   public function test_input($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }

   public function showMessage($type,$message){
      return '
      <div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
         <strong>'.$message.'</strong>.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';
   }

   public function timeAgo($timestamp){
      date_default_timezone_set('Asia/Phnom_Penh');
      $timestamp = strtotime($timestamp);
      $time = time() - $timestamp;
      switch($time){
         // Second
         case $time <= 60: 
            return 'Just Now';
         // Minutes
         case $time >= 60 && $time <3600:
            return (round($time/60) == 1)? 'a minute ago' : round($time/60).' minutes ago';
         // Hours 
         case $time >= 3600 && $time <86400:
            return (round($time/3600) == 1)? 'an hour ago' : round($time/3600).' hours ago';
         // Day 
         case $time >= 86400 && $time < 604800:
            return (round($time/86400) == 1)? 'a day ago' : round($time/86400).' days ago';
         // Week 
         case $time >= 604800 && $time < 2600640:
            return (round($time/604800) == 1)? 'a week ago': round($time/604800).' weeks ago';
         // Month 
         case $time >= 2600640 && $time <31207680:
            return (round($time/604800) == 1) ? 'a month ago': round($time/60).' months ago';
         // Year 
         case $time >= 31207680:
            return (round($time/31207680)== 1) ? 'a year ago': round($time/312076800).' years ago';

      }
   }


   }

?>