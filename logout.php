<?php include 'connect/db.php'; ?>
<?php 
if (mysqli_query($dbc,"UPDATE users SET sts=0 WHERE email='$_SESSION[user_login]'")):
	session_destroy();
?>
<p>Loggin out... Please Wait</p>
<script>
				setTimeout(function(){
					window.location="login.php";
				},1500);
			</script>
		<?php endif; ?>