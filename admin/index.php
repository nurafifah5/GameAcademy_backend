<?php
SESSION_START();
include("../database.php");

$db = new Database();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";
$level = (isset($_SESSION['level'])) ? $_SESSION['level'] : "";

if($token && $user_id && $level){
   $result = $db->execute("SELECT * FROM user WHERE user_id = '".$user_id."' AND token = '".$token."' AND status = 1 ");
   if(!$result) {
      header("Location: http://localhost/course_backend/");
   }
   $userdata = $db->get("SELECT user.email as email, user.username as username, user.status as status FROM user WHERE user.user_id = '".$user_id."'");               
   $userdata = mysqli_fetch_assoc($userdata);
} else {
   header("Location: http://localhost/gameacademy_backend/");
}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification) {
   echo $notification; 
   unset($_SESSION['notification']);   
}

?>

<h1>Welcome <?php echo $userdata['username'] ?>!</h1>

<table>
   <tr>MENU</tr>
   <tr>
      <td><a href="http://localhost/gameacademy_backend/user/">HOME</a></td>
      <td><a href="http://localhost/gameacademy_backend/game/">GAME</a></td>
      <td><a href="http://localhost/gameacademy_backend/game/leaderboard.php">LEADERBOARD</a></td>
      <td><a href="http://localhost/gameacademy_backend/user/logout.php">LOGOUT</a></td>
   </tr>
</table>
<br/>
<table border = 1>
   <tr>
      <td align="center" colspan=5>Profile</td>
   </tr>
   <tr>
      <td>Username</td>
      <td colspan=4><?php echo $userdata['username'];?></td>
   </tr>
   <tr>
      <td>Email</td>
      <td colspan=4><?php echo $userdata['email'];?></td>
   </tr>
   <tr>
      <td>Status</td>
      <td colspan=4>
         <?php if($userdata['status'] == 1) {
            echo "Active";
         } else {
            echo "Hiatus";
         } ?>
      </td>
   </tr>
</table>
