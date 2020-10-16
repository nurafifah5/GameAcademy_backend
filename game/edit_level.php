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

$leveldata = $db->get("SELECT * FROM level WHERE gameLevel_id = '".$_POST['levelid']."'");

?>

<h1>Welcome <?php echo $userdata['username'] ?>!</h1>
<p> Edit Level <br/></p>
<form action="edit_level_process.php" method="POST">
	<table>
		<?php while($e = mysqli_fetch_assoc($leveldata)) { ?>
			<input type="hidden" name="gameLevel_id" value="<?php echo $e['gameLevel_id'] ?>">
			<tr>
				<td>Level Name</td>
				<td>:</td>
				<td><input type="text" name="level_name" required value="<?php echo $e['level_name'] ?>"></td>
			</tr>
			<tr>
				<td>Description</td>
				<td>:</td>
				<td><input type="text" name="description" required value="<?php echo $e['description'] ?>"></td>
			</tr>
			<tr>
				<td colspan=3><input type="submit" value="EDIT LEVEL GAME"></td>
			</tr>      
		<?php } ?>
	</table>
</form>
<br/>
<button><a href="http://localhost/gameacademy_backend/game">Back to Games List Page</button>

