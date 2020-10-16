<?php
SESSION_START();
include("../database.php");

$db = new Database();

$gameLevel_id = $_POST['gameLevel_id'];
$level_name = $_POST['level_name'];
$description = $_POST['description'];

if($level_name && $description) {
	$result = $db->execute("UPDATE level SET level_name = '$level_name', description ='$description' WHERE gameLevel_id = '$gameLevel_id'");

	if($result){    
		$_SESSION["notification"] = "Game Level Details Update Success";    
	} else {    
		$_SESSION["notification"] = "Game Level Details Update Failed";
	}
}

header("Location: http://localhost/gameacademy_backend/game");   
?>
