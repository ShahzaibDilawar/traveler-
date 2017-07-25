<?php include 'connect/db.php'; ?>
<?php if(!isset($_SESSION['user_login'])): ?>
	<script>
		window.location="login.php";
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
		<?php include $page; ?>
	</div><!-- container -->
	<?php include 'inc/footer.php'; ?>
		<?php include 'links/foot.php'; ?>
		
	</body>
</html>
<?php endif; ?>
