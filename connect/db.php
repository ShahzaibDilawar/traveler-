<?php 
session_start();
$dbc = mysqli_connect('localhost','root','','nascon_17'); ?>
<!-- Fetching Login User Record -->
<?php @$fetchUser = fetchByEmail($dbc,"users",$_SESSION['user_login']); ?>
<!-- Function Area -->
<?php function fetchByEmail($dbc,$table,$email){
	return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE email='$email'"));
	} ?>
	<?php function fetchById($dbc,$table,$id){
	return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'"));
	} ?>
	<!-- get Message -->
	<?php function getMessage($msg,$sts){
		global $msg;
		global $sts;
		if (!empty($msg)) {
			# code...
			echo "<div class='alert alert-{$sts}'>{$msg}</div>";
		}
		} ?>