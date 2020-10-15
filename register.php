<?php
SESSION_START();
include("database.php");

$db = new Database();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $user_id){
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

<h2> Register New Account <br/></h2>

<form action="user/register_process.php" method="POST">
	<table>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" name="email" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="password" required></td>
		</tr>
		<tr>
			<td>Password (repeat)</td>
			<td>:</td>
			<td><input type="password" name="password2" required></td>
		</tr>  
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" required></td>
		</tr>  
		<tr>
			<td colspan=3><input type="submit" value="REGISTER"></td>
		</tr>      
	</table>
</form>
<br/>
<button><a href="http://localhost/gameacademy_backend/">Back to Login Page</button>