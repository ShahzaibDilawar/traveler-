<?php include 'inc/php_action/addExp.php'; ?>
<?php getMessage(@$msg,@$sts); ?>
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
<?php if(!empty($fetchUser['id'])): ?>
	<h1>Share Your Experience</h1>
	<div class="row">
		<div class="col-sm-3">
			<div class="list-group">
				<a href="#" class="list-group-item disabled">Added Trip</a>
				<?php $getTrip = mysqli_query($dbc,"SELECT * FROM trip WHERE user_id='$fetchUser[id]'");
				while($r=mysqli_fetch_assoc($getTrip)):
				 ?>
				<a href="index.php?nav=experience&trip_id=<?=$r['id']?>" class="list-group-item <?php if($_REQUEST['trip_id']==$r['id']){echo 'active';}?>"><?=ucwords($r['name'])?></a>
			<?php endwhile; ?>
			</div>
		</div><!-- col left -->
		<?php if(!empty($_REQUEST['trip_id'])): ?>

		<div class="col-sm-8">
		<?php $q = mysqli_query($dbc,"SELECT * FROM exp_categories");
				while($r=mysqli_fetch_assoc($q)):
				 ?>
			<div class="col-sm-3">
			
				<a href="index.php?nav=experience&trip_id=<?=$_REQUEST['trip_id']?>&cat_id=<?=$r['id'];?>" class="thumbnail">
					<h3>
					<span class="<?=$r['icon'];?>"></span>
					<br>
					<?=ucwords($r['name']);?></h3>
				</a>
			</div>
			<?php endwhile; ?>
			<?php if(!empty($_REQUEST['cat_id'])): ?>
				<form action="" method="POST" role="form" enctype="multipart/form-data">
					<legend>Add <?php $cat = fetchById($dbc,"exp_categories",$_REQUEST['cat_id']); echo $cat['name'];?></legend>
				
					<div class="form-group">
						<label for="">Title</label>
						<input required type="text" class="form-control" name="title" placeholder="Title">
					</div>
					<div class="form-group">
						<label for="">Description</label>
						<textarea name="description" id="" cols="30" rows="4" class="form-control" placeholder="Description"></textarea>
					</div>
					<div class="form-group">
						<label for="">Photo</label>
					<input type="file" name="f" data-target="#aImgShow" onChange="uploadImage(this)">
					<hr>
				<img src="" class="img img-thumbnail" height="180" width="180"  id="aImgShow"  alt="Default Pic">
					</div>
					<select name="along[]" multiple>
						<option value="" disabled>Select Friends</option>
						<?php $q = mysqli_query($dbc,"SELECT DISTINCT(user2) FROM frndlst WHERE user1='$fetchUser[id]' OR user2='$fetchUser[id]'");
						while($r=mysqli_fetch_assoc($q)):
							$user = fetchById($dbc,"users",$r['user2']);
						 ?>

						<option value="<?=$r['user2']?>"><?=$user['name']?></option>
					<?php endwhile; ?>
					</select>
				
					
				
					<button type="submit" name="save" class="btn btn-primary">Post</button>
				</form>
			<?php endif; ?>

		</div><!-- Right Area -->
		<?php else: ?>
		<h2 class="text-center text-muted">Choose Your Experience</h2>
	<?php endif; ?>
	</div>

<?php endif; ?>	