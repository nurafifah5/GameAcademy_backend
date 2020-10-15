<?php
SESSION_START();
include("database.php");

$db = new Database();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";
$level = (isset($_SESSION['level'])) ? $_SESSION['level'] : "";

if($token && $user_id && $level){
	$result = $db->execute("SELECT * FROM user WHERE user_id = '".$user_id."' AND token = '".$token."' AND status = 1 ");
	if($result){
		header("Location: http://localhost/gameacademy_backend/user/");
	}
}

// token tidak tersedia
$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification) {
	echo $notification;
	unset($_SESSION['notification']);   
}
?>

<h1>Welcome <?php echo $userdata['username'] ?>!</h1>
<p> Add New Level to Game <?php echo $_POST['sourcegamename'] ?>> <br/></p>

<form action="game/insert_level_process.php" method="POST">
	<table>
		<input type="hidden" name="game_id" value="<?php echo $_POST['sourcegameid'] ?>">
		<tr>
			<td>Level Name</td>
			<td>:</td>
			<td><input type="text" name="level_name" required></td>
		</tr>
		<tr>
			<td>Description</td>
			<td>:</td>
			<td><input type="text" name="description" required></td>
		</tr>
		<tr>
			<td colspan=3><input type="submit" value="ADD LEVEL"></td>
		</tr>      
	</table>
</form>
<br/>
<button><a href="http://localhost/gameacademy_backend/game">Back to Games List Page</button>

