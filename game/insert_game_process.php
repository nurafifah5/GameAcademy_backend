<?php
SESSION_START();
include("../database.php");

$db = new Database();

$game_name = $_POST['game_name'];
$time_start = $_POST['time_start'];
$time_end = $_POST['time_end'];
$status = 1;

if($game_name && $time_start && $time_end) {
	$result = $db->execute("INSERT INTO game(game_name, time_start, time_end, status) VALUES('".$game_name."', '".$time_start."', '".$time_end."', '".$status."')");

	if($result){    
		$_SESSION["notification"] = "Game Registration Success";    
	} else {    
		$_SESSION["notification"] = "Game Registration Failed";
	}
}
header("Location: http://localhost/gameacademy_backend/game");

?>