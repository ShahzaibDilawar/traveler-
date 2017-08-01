<?php include '../connect/db.php'; ?>
<?php 
	
	 $getPost = mysqli_query($dbc,"SELECT * FROM post ORDER BY id DESC");
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
		<div class="col-sm-6 col-sm-offset-3">
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
				<?php 
				$checkFriend = mysqli_query($dbc,"SELECT * FROM frndlst WHERE(user1='$fetchUser[id]' AND user2='$fetchPost[user_id]') OR (user1='$fetchPost[user_id]' AND user2='$fetchUser[id]')");
					if (!mysqli_num_rows($checkFriend)>=1) : ?>
					<a href="">Like</a> | <a data-toggle="collapse" href="#comment_<?=$fetchPost['id']?>">Comment</a> | <a href="">Share</a>
					<span id="commentBox"></span>
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
				<?php endif; ?>
				</div><!-- footer -->
			</div>
		</div><!-- news area -->
		<?php endwhile; ?>

			
