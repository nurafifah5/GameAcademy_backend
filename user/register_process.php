<?php
SESSION_START();
include("../database.php");

$db = new Database();

$email = $_POST['email'];
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);   
$username = $_POST['username'];
$token = "";
$status = 1;
$level = "user";

if($password == $password2) {
   if($email && $username) {
      $result = $db->execute("INSERT INTO user(email, username, token, status, password, level) VALUES('".$email."', '".$username."', '".$token."', '".$status."', '".$password."', '".$level."')");

      if($result){    
         $_SESSION["notification"] = "User Registration Success";    
      } else {    
         $_SESSION["notification"] = "User Registration Failed";
      }
   }
}
header("Location: http://localhost/gameacademy_backend/");   
?>
