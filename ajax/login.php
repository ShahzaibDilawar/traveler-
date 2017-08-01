<?php include '../connect/db.php'; ?>
<?php 
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	if ($email AND $password) {
		# code...
		if(mysqli_num_rows( mysqli_query($dbc,"SELECT * FROM users WHERE email='$email' AND password ='$password'"))==1){
			$msg = "Logging....";
			$sts = "success";
			if (mysqli_query($dbc,"UPDATE users SET sts=1 WHERE email='$email'")) {
				# code...
			$_SESSION['user_login']=$email;

			}
			?>
			<script>
				setTimeout(function(){
					window.location="index.php";
				},1500);
			</script>
			<?php
		}else{
			$msg = "Invalid Email or Password";
			$sts = "danger";
		}
		echo "<div class='alert alert-{$sts}'>{$msg}</div>";
	}

 ?>