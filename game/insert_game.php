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
<h3> Add New Game <br/></h3>

<form action="insert_game_process.php" method="POST">
	<table>
		<tr>
			<td>Game Name</td>
			<td>:</td>
			<td><input type="text" name="game_name" required></td>
		</tr>
		<tr>
			<td>Time Start</td>
			<td>:</td>
			<td><input type="date" name="time_start" required></td>
		</tr>
		<tr>
			<td>Time End</td>
			<td>:</td>
			<td><input type="date" name="time_end" required></td>
		</tr>  
		<tr>
			<td colspan=3><input type="submit" value="ADD GAME"></td>
		</tr>      
	</table>
</form>
<br/>
<button><a href="http://localhost/gameacademy_backend/game">Back to Games List Page</button>

