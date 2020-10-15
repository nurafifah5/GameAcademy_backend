<?php
SESSION_START();

include("database.php");
$db = new Database();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";
$level = (isset($_SESSION['level'])) ? $_SESSION['level'] : "";

if($token && $user_id && $level){
	$result = $db->execute("SELECT * FROM user WHERE user_id = '".$user_id."' AND token = '".$token."' AND status = 1");
	if($result){
		//redirect ke halaman user, token valid
		header("Location : http://localhost/gameacademy_backend/user/");
	} 
	//abaikan jika token tidak valid
}

//token tidak tersedua
$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";
if($notification){
	echo $notification;
	unset($_SESSION['notification']);
}

?>

<h1>Welcome!</h1>
<p>Please Login to continue <br/></p>

<form action = "user/login_process.php" method = "POST">
	<table>
		<tr>
			<td>Email</td>
			<td>: </td>
			<td><input type = "text" name="email" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>: </td>
			<td><input type = "password" name = "password" required></td>
		</tr>
		<tr>
			<td colspan=3><input type="submit" value="LOGIN"></td>
		</tr>
	</form>
	<br/>
	<tr>
		<td colspan=3><button><a href = "register.php">Dont have account? Register here!</a></button></td>
	</tr>
</table>
<br/>

<p>For trial purpose you can login as : <br/>
1. Admin using email "admin@gmail.com" and password "admin" <br/>
2. User using email "user@gmail.com" and password "user"</p>
