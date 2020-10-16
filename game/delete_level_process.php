<?php
SESSION_START();
include("../database.php");

$db = new Database();

$gameLevel_id = $_POST['levelid'];

if($gameLevel_id) {
	$result = $db->execute("DELETE FROM level WHERE gameLevel_id = '$gameLevel_id'");

	if($result){    
		$_SESSION["notification"] = "Game Level Successfully Deleted";    
	} else {    
		$_SESSION["notification"] = "Game Level Delete Process Failed";
	}
}

header("Location: http://localhost/gameacademy_backend/game");   
?>
