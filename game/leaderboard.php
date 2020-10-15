<?php
SESSION_START();
include("../database.php");

$db = new Database();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";
$level = (isset($_SESSION['level'])) ? $_SESSION['level'] : "";

if($token && $user_id && $level) {
  $result = $db->execute("SELECT * FROM user_tbl WHERE nik = '".$nik."' AND token = '".$token."' AND status = 1 ");
  if(!$result) {
    header("Location: http://localhost/course_backend/");
  }
  $userdata = $db->get("SELECT user.email as email, user.username as username FROM user WHERE user.user_id = '".$user_id."' ");               
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

<h2>LEADERBOARD<br/></h2>

<table>
   <tr>MENU</tr>
   <tr>
      <td><a href="http://localhost/gameacademy_backend/user/">HOME</a></td>
      <td><a href="http://localhost/gameacademy_backend/user/statistik.php">STATISTIK</a></td>       
      <td><a href="http://localhost/gameacademy_backend/user/leaderboard.php">LEADERBOARD</a></td>
      <td><a href="http://localhost/gameacademy_backend/user/logout.php">LOGOUT</a></td>
   </tr>
</table>
<br/>

<form action="http://localhost/course_backend/user/leaderboard.php" method='GET'>
Pilih Game
  <select name="gameid">
  <?php 
  $gamedata = $db->get("SELECT game_id,nama FROM game_tbl WHERE status=1");                                

   while($row = mysqli_fetch_assoc($gamedata))

   {

     ?>

     <option value="<?php echo $row['game_id']?>"><?php echo $row['nama']?></option>

     <?php

   }

   ?>

 </select>

 <input type="submit" value="Tampilkan Leaderboard">

</form>

<?php

if(isset($_GET['gameid']))

{

 echo "LEADERBOARD GAME ID :".$_GET['gameid'];

 ?>

 <table border=1>

   <tr><td>NO</td><td>NAMA</td><td>SCORE</td></tr>

   <?php

   $leaderboarddata = $db->get("SELECT user_tbl.nama_depan as nama_depan, user_tbl.nama_belakang as nama_belakang, max(user_game_data_tbl.score) as score FROM user_tbl, user_game_data_tbl WHERE user_tbl.nik = user_game_data_tbl.nik AND user_game_data_tbl.game_id = ".$_GET['gameid']." GROUP BY user_tbl.nik ORDER BY score DESC");

   $no = 0;

   while($row = mysqli_fetch_assoc($leaderboarddata))

   {

     $no++;

     ?>

     <tr>

       <td><?php echo $no?></td>

       <td><?php echo $row['nama_depan']." ".$row['nama_belakang']?></td>

       <td><?php echo $row['score']?></td>               

     </tr>

     <?php

   }

   ?>

 </table>

 <?php

}

?>