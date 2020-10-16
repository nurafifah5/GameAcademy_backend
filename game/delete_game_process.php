<?php
SESSION_START();
include("../database.php");

$db = new Database();

$game_id = $_POST['gameid'];

if($game_id) {
	$result = $db->execute("DELETE FROM game WHERE game_id = '$game_id'");

	if($result){    
		$_SESSION["notification"] = "Game Successfully Deleted";    
	} else {    
		$_SESSION["notification"] = "Game Delete Process Failed";
	}
}

header("Location: http://localhost/gameacademy_backend/game");   
?>
