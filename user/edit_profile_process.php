<?php
SESSION_START();
include("../database.php");

$db = new Database();

$user_id = $_POST['user_id'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);   
$username = $_POST['username'];

if($password == $password2) {
   if($email && $username) {
      $result = $db->execute("UPDATE user SET email = '$email', username = '$username' WHERE user_id = '$user_id'");

      if($result){    
         $_SESSION["notification"] = "User Profile Update Success";    
      } else {    
         $_SESSION["notification"] = "User Profile Update Failed";
      }
   }
}
header("Location: http://localhost/gameacademy_backend/user");   
?>
