<?php
SESSION_START();
include("../database.php");

$db = new Database();

$level_name = $_POST['level_name'];
$description = $_POST['description'];
$game_id = $_POST['game_id'];

if($level_name && $description && $game_id) {
	$result = $db->execute("INSERT INTO level(level_name, description, game_id) VALUES('".$level_name."', '".$description."', '".$game_id."')");

	if($result){    
		$_SESSION["notification"] = "Level Registration Success";    
	} else {    
		$_SESSION["notification"] = "Level Registration Failed;
	}
}

header("Location: http://localhost/gameacademy_backend/game");   
?>