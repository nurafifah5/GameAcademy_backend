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

$gamedata = $db->get("SELECT * FROM game WHERE game_id = '".$_POST['gameid']."'");

?>

<h1>Welcome <?php echo $userdata['username'] ?>!</h1>
<p> Edit Game <br/></p>
<form action="edit_game_process.php" method="POST">
	<table>
		<?php while($g = mysqli_fetch_assoc($gamedata)) { ?>
			<input type="hidden" name="game_id" value="<?php echo $g['game_id'] ?>">
			<tr>
				<td>Game Name</td>
				<td>:</td>
				<td><input type="text" name="game_name" required value="<?php echo $g['game_name'] ?>"></td>
			</tr>
			<tr>
				<td>Time Start</td>
				<td>:</td>
				<td><input type="date" name="time_start" required value="<?php echo $g['time_start'] ?>"></td>
			</tr>
			<tr>
				<td>Time End</td>
				<td>:</td>
				<td><input type="date" name="time_end" required value="<?php echo $g['time_end'] ?>"></td>
			</tr>  
			<tr>
				<td colspan=3><input type="submit" value="EDIT GAME"></td>
			</tr>      
		<?php } ?>
	</table>
</form>
<br/>
<button><a href="http://localhost/gameacademy_backend/game">Back to Games List Page</button>

