<?php include 'connect/db.php'; ?>
<?php if (isset($_REQUEST['query'])) {
	# code...
	$_SESSION['query'] = $_REQUEST['query'];
		$getPost = mysqli_query($dbc,"SELECT * FROM post WHERE title LIKE '%$_REQUEST[query]%' OR description LIKE '%$_REQUEST[query]%' ORDER BY id DESC");

}else{
	$getPost = mysqli_query($dbc,"SELECT * FROM post ORDER BY id DESC");
	} ?>
<?php if (@$_REQUEST['action']=='like') {
	# code...
	$post_id = $_REQUEST['post_id'];
	$user_id  = $fetchUser['id'];
	if (mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM likes_tbl WHERE post_id='$post_id' AND user_id='$user_id'"))>=1) {

	}else{
		mysqli_query($dbc,"INSERT INTO likes_tbl(user_id,post_id) VALUES('$user_id','$post_id')");
	}
	?>	
	<script>
			window.location='feeds.php';

	</script>
	<?php
} ?>

<!-- Share Code -->
<?php if (!empty($_REQUEST['post_id']) AND $_REQUEST['share_id']) {
	# code...
	$post_id = $_REQUEST['post_id'];
	$share_id = $_REQUEST['share_id'];
	if ($post_id AND $share_id) {
		# code...
		if (mysqli_query($dbc,"INSERT INTO share(post_id,user_id) VALUES('$post_id','$share_id')")) {
			# code...
			$msg = "Shared Successfully";
			$sts="success";

			?>
			<script>
			setTimeout(function(){
				window.location='feeds.php';
	
			},1000);
			</script>
			<?php
		}else{
			$msg = mysqli_error($dbc);
			$sts="dnager";
		}
	}
} ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'links/head.php'; ?>

	</head>
	<body>
	<?php include 'inc/nav.php'; ?>
	<div class="container">
		<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Your Share Post <span class="badge">
		<?php echo mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM share WHERE user_id='$fetchUser[id]'"));?></span></a>
		<hr>
		<div class="modal fade" id="modal-id">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Post Shared</h4>
					</div>
					<div class="modal-body">
					<div class="row">
						<?php $q = mysqli_query($dbc,"SELECT * FROM share WHERE user_id='$fetchUser[id]'");
						while($r=mysqli_fetch_assoc($q)):
							$post = fetchById($dbc,"post",$r['post_id']);
						 ?>
						<div class="col-sm-4">
							<a href="post_uploads/<?=$post['pic']?>" target="_blank" class="thumbnail">
								<img src="post_uploads/<?=$post['pic']?>" class="img img-responsive"  alt="">
							</a>
						</div>
					<?php endwhile; ?>
					</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="container">
	<form action="feeds.php" method="post">
	<input type="text" placeholder="Seacrh...." id="query" name="query" class="form-control" value="<?=@$_SESSION['query'];?>" autofocus>
	</form>
	<hr>

	<?php getMessage(@$msg,@$sts); ?>
	<div class="row" id="getFeeds">
		<?php 
		if(mysqli_num_rows($getPost)==0){echo "<p class='text-muted text-center'>No Post Found</p>";}
		else{
	while($fetchPost =mysqli_fetch_assoc($getPost)):
	$cat = fetchById($dbc,"exp_categories",$fetchPost['cat_id']);
	$trip = fetchById($dbc,"trip",$fetchPost['trip_id']);
	$along = explode(',', $fetchPost['along']);
	$loc_id = $trip['location_id'];
	$location = fetchById($dbc,"location",$loc_id);
	$fetchUser = fetchById($dbc,"users",$fetchPost['user_id']);
	 $name="";
   foreach($along as $val):
  $user = fetchById($dbc,"users",$val);
      $name.=' <a href="index.php?nav=user_profile&user_id='.$val.'"><label for="" class="label label-default">'.$user['name'].'</label></a>';
     endforeach; 
	 ?>
		<div class="col-sm-6 col-sm-offset-3" style="border-right:1px solid #eee">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?=ucwords($fetchUser['name'])?></h3>
				</div><!-- heading -->
				<div class="panel-body">
					<img src="post_uploads/<?=$fetchPost['pic']?>" alt="" width="100%" height="300" class="img img-rounded img-responsive">
					<hr>
					<h3 class="page-header"><?=$trip['name']?> <small><?=$fetchPost['title']?></small></h3>
					<a href="albums.php?postid=<?=$fetchPost['id']?>&action=view&postid=<?=$fetchPost['id']?>" class="btn btn-xs btn-info">Album</a> <?php if(!empty($name)){echo $name;}?>
					<br>
					<br>
					<div class="well well-sm">
					<b>Description: </b>
					<?=$fetchPost['description']?>
					</div>
				</div><!-- body -->
				<div class="panel-footer">
				<?php $count = mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM likes_tbl WHERE post_id='$fetchPost[id]'")); ?>
					<a href="feeds.php?post_id=<?=$fetchPost['id']?>&action=like">Like</a> <span class="badge"><?=$count?></span> | <a data-toggle="collapse" href="#comment_<?=$fetchPost['id']?>">Comment</a> | <a href="feeds.php?post_id=<?=$fetchPost['id']?>&share_id=<?=$fetchUser['id']?>">Share</a>
					
					<?php $q = mysqli_query($dbc,"SELECT  * FROM comments WHERE post_id='$fetchPost[id]'");
					if(mysqli_num_rows($q)>=1):
						while($r=mysqli_fetch_assoc($q)):
							  $user = fetchById($dbc,"users",$r['user_id']);

					 ?>
					<hr>
						<blockquote style="padding: 0px;font-size: 14px;">
							<p><b><?= ucwords($user['name'])?> : </b><?=$r['comment']?></p>
						</blockquote>
				<?php endwhile; ?>

				<?php endif; ?>
					<div class="well collapse" id="comment_<?=$fetchPost['id']?>">
						<form action="ajax/commentBox.php" method="post" class="commentForm">
						<textarea class="form-control" name="comment" id="" cols="30" rows="4" placeholder="Type Your Comment"></textarea>
						<input type="hidden" value="<?=$fetchPost['id']?>" name="post_id">
						<button class="btn btn-primary btn-xs" type="submit">Comment</button>
						</form>	
					</div>
				</div><!-- footer -->
			</div>
		</div><!-- news area -->
		<?php endwhile; }?>
	</div><!-- row -->
	</div><!-- container -->
	<?php include 'inc/footer.php'; ?>
		<?php include 'links/foot.php'; ?>
		<script src="js/comment.js"></script>
	</body>
</html>
