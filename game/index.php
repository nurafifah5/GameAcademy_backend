<?php
SESSION_START();
include("../database.php");

$db = new Database();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";
$level = (isset($_SESSION['level'])) ? $_SESSION['level'] : "";

if($token && $user_id && $level){
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
<h3>PAGE : GAMES LIST </h3>

<table>
   <tr>MENU</tr>
   <tr>
      <td><a href="http://localhost/gameacademy_backend/admin/">HOME</a></td>
      <td><a href="http://localhost/gameacademy_backend/game/">GAME</a></td>
      <td><a href="http://localhost/gameacademy_backend/game/leaderboard.php">LEADERBOARD</a></td>
      <td><a href="http://localhost/gameacademy_backend/user/logout.php">LOGOUT</a></td>
   </tr>
</table>
<br/>
<button><a href = "../game/insert_game.php">Add new game</a></button>
<br/><br/>
<table border = 1>
   <tr>
      <td>Name</td>
      <td>Start Time</td>
      <td>End Time</td>
      <td>Status</td>
      <td></td>
      <td></td>
      <td></td>
   </tr>
   <?php 
   $gamedata = $db->get("SELECT * FROM game");               
   while($g = mysqli_fetch_assoc($gamedata)) {
      ?>
      <tr>
         <td><?php echo $g['game_name'];?></td>
         <td><?php echo $g['time_start'];?></td>
         <td><?php echo $g['time_end'];?></td>
         <td>
            <?php if($g['status'] == 1) {
               echo "Active";
            } else {
               echo "Hiatus";
            } ?>
         </td>
         <td>
            <form action="http://localhost/gameacademy_backend/game/" method='GET'>
               <input type="hidden" name="gameid" value="<?php echo "".$g['game_id'].""; ?>">
               <input type="hidden" name="gamename" value="<?php echo "".$g['game_name'].""; ?>">
               <input type="submit" value="Show Levels">
            </form>
         </td>
         <td>
            <form action="http://localhost/gameacademy_backend/game/edit_game.php" method='POST'>
               <input type="hidden" name="gameid" value="<?php echo "".$g['game_id'].""; ?>">
               <input type="submit" value="EDIT">
            </form>
         </td>
         <td>
            <form action="http://localhost/gameacademy_backend/game/delete_game_process.php" method='POST'>
               <input type="hidden" name="gameid" value="<?php echo "".$g['game_id'].""; ?>">
               <input type="submit" value="DELETE">
            </form>
         </td>
      </tr>

      <?php 
   }
   ?>
</table>
<br/><br/>



<!-- SHOW LEVEL LIST !-->
<?php
if(isset($_GET['gameid'])) {
   echo "".$_GET['gamename']." Level List <br/>"; ?>
   <br/>
   <form action="http://localhost/gameacademy_backend/game/insert_level.php" method='POST'>
      <input type="hidden" name="gameid" value="<?php echo "".$_GET['gameid'].""; ?>">
      <input type="hidden" name="gamename" value="<?php echo "".$_GET['gamename'].""; ?>">
      <input type="submit" value="Add New Level">
   </form>
   <table border = 1>
      <tr>
         <td>Name</td>
         <td>Description</td>
         <td></td>
         <td></td>
      </tr>
      <?php 
      $leveldata = $db->get("SELECT * FROM level WHERE level.game_id = '".$_GET['gameid']."'");
      if($leveldata) {               
         while($e = mysqli_fetch_assoc($leveldata)) {
            ?>
            <tr>
               <td><?php echo $e['level_name'];?></td>
               <td><?php echo $e['description'];?></td>
               <td>
                  <form action="http://localhost/gameacademy_backend/game/edit_level.php" method='POST'>
                     <input type="hidden" name="levelid" value="<?php echo "".$e['gameLevel_id'].""; ?>">
                     <input type="submit" value="EDIT">
                  </form>
               </td>
               <td>
                  <form action="http://localhost/gameacademy_backend/game/delete_level_process.php" method='POST'>
                     <input type="hidden" name="levelid" value="<?php echo "".$e['gameLevel_id'].""; ?>">
                     <input type="submit" value="DELETE">
                  </form>
               </td>
            </tr>
            <?php 
         }
      }
      ?>
   </table>


   <?php
}
?>