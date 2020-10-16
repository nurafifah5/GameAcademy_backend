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

$statisticdata = $db->get("SELECT game.game_name as game_name, level.level_name as level_name, MIN(score.score) as min, MAX(score.score) as max, AVG(score.score) as avg, score.time_submit as time_submit FROM user, score, level, game WHERE game.game_id = level.game_id AND score.gameLevel_id = level.gameLevel_id AND score.user_id = '".$user_id."' group by level.gameLevel_id");               
} else {
 header("Location: http://localhost/course_backend/");
}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";
if($notification) {
  echo $notification;
  unset($_SESSION['notification']);   
}

?>

<h1>Welcome <?php echo $userdata['username'] ?>!</h1>
<h3>PAGE : USER STATISTIC GAME SCORE </h3>

<table>
 <tr>MENU</tr>
 <tr>
  <td><a href="http://localhost/gameacademy_backend/user/">HOME</a></td>
  <td><a href="http://localhost/gameacademy_backend/user/statistik.php/">STATISTIC</a></td>
  <td><a href="http://localhost/gameacademy_backend/game/leaderboard.php">LEADERBOARD</a></td>
  <td><a href="http://localhost/gameacademy_backend/user/logout.php">LOGOUT</a></td>
</tr>
</table>
<br/>

<button><a href = "insert_score.php">Add new score</a></button>
<br/><br/>

<table border=1>
  <tr>
    <td>GAME</td>
    <td>LEVEL</td>
    <td>MIN</td>
    <td>MAX</td>
    <td>AVG</td>
    <td>TIME SUBMIT</td>
  </tr>
  <?php
  if($statisticdata){
    while($row = mysqli_fetch_assoc($statisticdata)) {
      ?>
      <tr>
       <td><?php echo $row['game_name']?></td>
       <td><?php echo $row['level_name']?></td>
       <td><?php echo $row['min']?></td>
       <td><?php echo $row['max']?></td>
       <td><?php echo $row['avg']?></td>               
       <td><?php echo $row['time_submit']?></td>
     </tr>
     <?php
   } 
 }?>


</table>