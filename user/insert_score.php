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
<h3> Add New Score <br/></h3>

<!--CHOOSE GAME -->
<form action="http://localhost/gameacademy_backend/user/insert_score.php" method='GET'>
	Choose Game
	<select name="gameid">
		<?php
		$gamedata = $db->get("SELECT game_id,game_name FROM game WHERE status=1");
		while($row = mysqli_fetch_assoc($gamedata)) { ?>
			<option value="<?php echo $row['game_id']?>"><?php echo $row['game_name']?></option>
		<?php } ?>
	</select>
	<input type="submit" value="Show Level">
</form>

<!-- CHOOSE LEVEL !-->
<?php
if(isset($_GET['gameid'])) { ?>
	<form action="http://localhost/gameacademy_backend/user/insert_score.php" method='GET'>
		Choose Level
		<select name="levelid">
			<?php
			$leveldata = $db->get("SELECT gameLevel_id, level_name FROM level WHERE game_id = '".$_GET['gameid']."'");
			while($row = mysqli_fetch_assoc($leveldata)) { ?>
				<option value="<?php echo $row['gameLevel_id']?>"><?php echo $row['level_name']?></option>
			<?php } ?>
		</select>
		<input type="submit" value="Insert Details">
	</form>
<?php } ?>

<!--INSERT DETAILS !-->
<?php
if(isset($_GET['levelid'])) { ?>
	<form action="insert_score_process.php" method="POST">
		<?php $scoredata = $db->get("SELECT game.time_start, game.time_end, level.level_name FROM game, level WHERE game.game_id = level.game_id AND level.gameLevel_id = '".$_GET['levelid']."'");
		while($row = mysqli_fetch_assoc($scoredata)) { ?>
			<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
			<input type="hidden" name="gameLevel_id" value="<?php echo $_GET['levelid']?>">
			<input type="hidden" name="time_start" value="<?php echo $row['time_start'] ?>">
			<input type="hidden" name="time_end" value="<?php echo $row['time_end'] ?>">
			<table>
				<tr>
					<td>Score (0-100)</td>
					<td>:</td>
					<td><input type="text" name="score" required></td>
				</tr>
				<tr>
					<td colspan=3><input type="submit" value="ADD SCORE"></td>
				</tr>      
			</table>
		<?php } ?>
	</form>
	<br/>
<?php } ?>

<button><a href="http://localhost/gameacademy_backend/user/statistik.php">Back to Statistic Page</button>

