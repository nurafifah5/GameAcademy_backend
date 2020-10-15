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
<p>Games List </p>

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
            <button><a href = "../game/edit_game.php">EDIT</a></button>
         </td>
         <td>
            <button><a href = "../game/delete_game.php">DELETE</a></button>
         </td>
      </tr>
      <?php 
   }
   ?>
</table>
<br/><br/>

<?php
//show level lists

if(isset($_GET['gameid'])) {
   echo "".$_GET['gamename']." Level List <br>"; ?>
   
   <!--<form action="http://localhost/gameacademy_backend/game/insert_level.php" method='POST'>
      <input type="hidden" name="sourcegameid" value="<?php echo "".$gamedata['game_id'].""; ?>">
      <input type="hidden" name="sourcegamename" value="<?php echo "".$gamedata['game_name'].""; ?>">
      <input type="submit" value="Add new level">
   </form>-->
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
               <button><a href = "../game/edit_game.php">EDIT</a></button>
            </td>
            <td>
               <button><a href = "../game/delete_game.php">DELETE</a></button>
            </td>
         </tr>
         <?php 
      }
      ?>
   </table>


   <?php
}
?>