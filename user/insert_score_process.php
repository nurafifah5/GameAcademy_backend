<?php
SESSION_START();
include("../database.php");

$db = new Database();

$user_id = $_POST['user_id'];
$gameLevel_id = $_POST['gameLevel_id'];
$score = $_POST['score'];
$time_start = $_POST['time_start'];
$time_end = $_POST['time_end'];

//compare date
$today = date("Y-m-d");
if($today > $time_start && $today < $time_end){
	if($score && $user_id && $gameLevel_id){
		$result = $db->execute("INSERT INTO score(user_id, gameLevel_id, score) VALUES('".$user_id."', '".$gameLevel_id."', '".$score."')");

		if($result){    
			$_SESSION["notification"] = "Game Score Registration Success";    
		} else {    
			$_SESSION["notification"] = "Game Score Registration Failed";
		}	
	}
} else {
	if($today < $time_start){
		$_SESSION["notification"] = "Game Score Registration has not started yet";
	} else if ($today > $time_end){
		$_SESSION["notification"] = "Game Score Registration Time Limit has passed";
	}
}

header("Location: http://localhost/gameacademy_backend/user/statistik.php");

?>