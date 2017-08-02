<?php include '../connect/db.php'; ?>
<?php 
	$name = mysqli_real_escape_string($dbc,strip_tags($_REQUEST['name']));

	$email = mysqli_real_escape_string($dbc,strip_tags($_REQUEST['email']));
	$password = mysqli_real_escape_string($dbc,strip_tags($_REQUEST['password']));
	if ($email AND $password AND $name) {
		# code...
		if(mysqli_num_rows( mysqli_query($dbc,"SELECT * FROM users WHERE email='$email'"))>=1){
			$msg = $email." has Already Taken....";
			$sts = "info";
		}else{
			if (mysqli_query($dbc,"INSERT INTO users(name,email,password) VALUES('$name','$email','$password')")) {
				# code...
				$msg = $name." has successfully Registered....";
				$sts = "success";
			
			?>
			<script>
				setTimeout(function(){
					window.location="login.php";
				},1500);
			</script>
			<?php
		}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
		}
	}
}
		echo "<div class='alert alert-{$sts}'>{$msg}</div>";


 ?>