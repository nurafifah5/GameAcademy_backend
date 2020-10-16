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
 header("Location: http://localhost/course_backend/");
}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";
if($notification) {
  echo $notification;
  unset($_SESSION['notification']);   
}

?>


<h1>Welcome <?php echo $userdata['username'] ?>!</h1>
<h3>PAGE : LEADERBOARD</h3>

<table>
 <tr>MENU</tr>
 <tr>
  <td><a href="http://localhost/gameacademy_backend/user/">HOME</a></td>
  <?php if($level == "admin"){ ?>
    <td><a href="http://localhost/gameacademy_backend/game/">GAME</a></td>
  <?php } else { ?>
    <td><a href="http://localhost/gameacademy_backend/user/statistik.php/">STATISTIK</a></td>
  <?php }
  ?>
  <td><a href="http://localhost/gameacademy_backend/game/leaderboard.php">LEADERBOARD</a></td>
  <td><a href="http://localhost/gameacademy_backend/user/logout.php">LOGOUT</a></td>
</tr>
</table>
<br/>

<form action="http://localhost/gameacademy_backend/game/leaderboard.php" method='GET'>
  Choose Game
  <select name="gameid">
   <?php
   $gamedata = $db->get("SELECT game_id, game_name FROM game WHERE status=1");
   while($row = mysqli_fetch_assoc($gamedata)) { ?>
    <option value="<?php echo $row['game_id']?>"><?php echo $row['game_name']?></option>
  <?php } ?>
</select>
<input type="submit" value="Show Leaderboard">
</form>

<?php
if(isset($_GET['gameid'])) {
 echo "LEADERBOARD GAME ID :".$_GET['gameid'];
 ?>

 <table border=1>
   <tr>
    <td>NO</td>
    <td>NAME</td>
    <td>LEVEL NAME</td>
    <td>SCORE</td>
  </tr>

  <?php
  $leaderboarddata = $db->get("SELECT user.username as username, level.level_name as level_name, max(score.score) as score FROM game, user, level, score WHERE game.game_id = level.game_id AND level.gameLevel_id = score.gameLevel_id AND user.user_id = score.user_id AND game.game_id = ".$_GET['gameid']." GROUP BY score.gameLevel_id ORDER BY score DESC");
  $no = 0;

  if($leaderboarddata){
    while($row = mysqli_fetch_assoc($leaderboarddata)) {
     $no++; ?>
     <tr>
      <td><?php echo $no?></td>
      <td><?php echo $row['username']?></td>
      <td><?php echo $row['level_name']?></td>               
      <td><?php echo $row['score']?></td>               
    </tr>
    <?php
  } }
  ?>
</table>

<?php
}
?>