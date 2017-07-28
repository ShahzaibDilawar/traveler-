<?php include 'connect/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'links/head.php'; ?>
	</head>
	<body>
	<?php include 'inc/nav.php'; ?>
	<div class="container">
			<style>
			.thumbnail{
				text-decoration: none;
				color: #000;
				text-align: center;
				font-size: 15px;
			}
			.thumbnail:hover{
				text-decoration: none;
			}
		</style>

		<?php if(!empty($_REQUEST['postid']) AND $_REQUEST['action']=='view'):
		$post= fetchById($dbc,"post",$_REQUEST['postid']);
		$trip= fetchById($dbc,"trip",$post['trip_id']);

		?>
		<h1 class="page-header"><?=@$trip['name']?> <small><?=@$post['title']?></small></h1>
		<?php $getAlbum = mysqli_query($dbc,"SELECT * FROM albums WHERE post_id='$_REQUEST[postid]'");
			while($fetchAlbum=mysqli_fetch_assoc($getAlbum)):
		 ?>
			<div class="col-sm-4">
				<a href="uploads/<?=$fetchAlbum['pic']?>" target="_blank" class="thumbnail">
				<img src="uploads/<?=$fetchAlbum['pic']?>" heigh="200" width="200" alt="" class="img img-responsive">
				<p class="text-muted"><?=$fetchAlbum['add_date']?></p>
				</a>
			</div>
		<?php endwhile; ?>
		<?php endif; ?>

	</div><!-- container -->
	<?php include 'inc/footer.php'; ?>
		<?php include 'links/foot.php'; ?>
	</body>
</html>
