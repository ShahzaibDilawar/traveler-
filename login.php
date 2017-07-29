<?php include 'connect/db.php'; ?>
<?php if(isset($_SESSION['user_login'])): ?>
	<script>
		window.location="index.php";
	</script>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'links/head.php'; ?>
	</head>
	<body>
	<?php include 'inc/nav.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Login Below !</h3>
					</div>
					<div class="panel-body">
					<span id="response"></span>
						<ul class="nav nav-tabs">
							<li><a href="#login" data-toggle="tab">Login</a></li>
							<li><a href="#register" data-toggle="tab">Register</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="login">
								<form action="ajax/login.php" method="POST" role="form" id="loginForm">
									<div class="form-group">
										<label for="">Email</label>
										<input type="text" required class="form-control" name="email" placeholder="Email...">
									</div>
									<div class="form-group">
										<label for="">Password</label>
										<input type="password" required class="form-control" name="password" placeholder="Password...">
									</div>
									<button type="submit" name="login" class="btn btn-success">Login</button>
								</form><!-- form login -->
							</div><!-- login Form -->
							<div class="tab-pane" id="register">
							<form action="ajax/register.php" method="POST" role="form" id="registerForm">
								<div class="form-group">
									<label for="">Name</label>
									<input type="text" required class="form-control" name="name" placeholder="Name...">
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="text" required class="form-control" name="email" placeholder="Email...">
								</div>
								<div class="form-group">
									<label for="">Password</label>
									<input type="password" required class="form-control" name="password" placeholder="Password...">
								</div>
								<button type="submit" name="register" class="btn btn-primary">Register</button>
							</form><!-- form login -->
							</div><!-- register form -->
						</div>
					</div><!-- body -->
				</div><!-- default -->
			</div><!-- col  -->
		</div><!-- row -->
	</div><!-- container -->
		<?php include 'links/foot.php'; ?>
		<script src="js/login.js"></script>
	</body>
</html>
<?php endif; ?>



				