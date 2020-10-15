<?php
SESSION_START();
include("../database.php");
$db = new Database();

$email = $_POST['email'];
$password = md5($_POST['password']);
$result = $db->get("SELECT user_id FROM user WHERE email= '".$email."' AND password='".$password."' ");

if($result) {
  $userdata = $db->get("SELECT user_id as user_id, level as level FROM user WHERE email = '".$email."' AND password = '".$password."' ");               
  $userdata = mysqli_fetch_assoc($userdata);
  $result_level = $userdata['level'];
  $result_id = $userdata['user_id'];

  $_SESSION['notification'] = "Login Success";
  $token = md5($result_id."gameacademybackend".date("Y-m-d H:i:s"));
  $db->execute("UPDATE user SET token = '".$token."' WHERE user_id  = '".$result_id."'");

  $_SESSION['token'] = $token;
  $_SESSION['level'] = $result_level;
  $_SESSION['user_id'] = $result_id;
  if($result_level == "admin") {
    header("Location: http://localhost/gameacademy_backend/admin/");
  } else {
    header("Location: http://localhost/gameacademy_backend/user/");
  }
} else {
  $_SESSION['notification'] = "Login Failed, Try Again";
  header("Location: http://localhost/gameacademy_backend");  
}


?>