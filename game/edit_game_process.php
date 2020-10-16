<?php
SESSION_START();
include("../database.php");

$db = new Database();

$game_id = $_POST['game_id'];
$game_name = $_POST['game_name'];
$time_start = $_POST['time_start'];
$time_end = $_POST['time_end'];

if($game_name && $time_start && $time_end) {
	$result = $db->execute("UPDATE game SET game_name = '$game_name', time_start = '$time_start', time_end ='$time_end' WHERE game_id = '$game_id'");

	if($result){    
		$_SESSION["notification"] = "Game Details Update Success";    
	} else {    
		$_SESSION["notification"] = "Game Details Update Failed";
	}
}

header("Location: http://localhost/gameacademy_backend/game");   
?>
