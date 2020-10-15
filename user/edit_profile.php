<?php
SESSION_START();
include("../database.php");

$db = new Database();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $user_id){
	$userdata = $db->get("SELECT user.email as email, user.username as username, user.status as status FROM user WHERE user.user_id = '".$user_id."'");               
	$userdata = mysqli_fetch_assoc($userdata);
}

// token tidak tersedia
$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification) {
	echo $notification;
	unset($_SESSION['notification']);   
}
?>

<h1>Welcome <?php echo $userdata['username'] ?>!</h1>
<p>Edit Profile </p>

<form action="edit_profile_process.php" method="POST">
	<table>
		<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" name="email" required></td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" required></td>
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
			<td colspan=3><input type="submit" value="UPDATE PROFILE"></td>
		</tr>      
	</table>
</form>
<br/>
<button><a href="http://localhost/gameacademy_backend/">Back to Home Page</button>