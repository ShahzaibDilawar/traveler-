<?php if (isset($_REQUEST['delete_all'])) {
	# code...
	@$delete = $_REQUEST['delete'];
	if ($delete) {
		# code...
		foreach ($delete as  $value) {
		# code...
		$q = mysqli_query($dbc,"DELETE FROM post WHERE id='$value'");
	}
	if ($q) {
		# code...
		$msg = "Selected Posts Deleted";
		$sts ="danegr";
	}else{
		$msg=mysqli_error($dbc);
		$sts="danegr";
	}
	}
	
} ?>
<?php getMessage(@$msg,@$sts); ?>
<h1>History Experieces</h1>
<hr>
<form method="post">
	<table class="table myTable">
		<thead>
			<tr>
				<th>Trip</th>
				<th>Title</th>
				<th>Date</th>
				<th>Category</th>
				<th>Pic</th>
				<th>Friend With</th>
				<th>Geographical View <button name="delete_all" class="btn btn-sm btn-danger">Delete</button></th>
			</tr>
		</thead>
		<tbody>
		<?php $getPost = mysqli_query($dbc,"SELECT * FROM post WHERE user_id='$fetchUser[id]'");
		while($fetchPost =mysqli_fetch_assoc($getPost)):
			$cat = fetchById($dbc,"exp_categories",$fetchPost['cat_id']);
			$trip = fetchById($dbc,"trip",$fetchPost['trip_id']);
			$along = explode(',', $fetchPost['along']);
			$loc_id = $trip['location_id'];
			$location = fetchById($dbc,"location",$loc_id);
		 ?>
			<tr title="<?=$fetchPost['description']?>" data-toggle="tooltip">
				<td><?=$trip['name']?></td>
				<td><?=substr($fetchPost['title'], 0,20)?></td>
				<td><?=$fetchPost['add_date']?></td>
				<td><?=$cat['name'];?></td>
				<td><img src="post_uploads/<?=$fetchPost['pic']?>" alt="" width="150" height="150" class="img img-rounded img-responsive">
				<a href="index.php?nav=albums&action=view&postid=<?=$fetchPost['id']?>" class="btn btn-xs btn-info">Album</a></td>
				<td>
					<?php foreach($along as $val):
						$user = fetchById($dbc,"users",$val);
						 ?>
						 	<a href="index.php?nav=user_profile&user_id=<?=$val?>"><label for="" class="label label-default"><?=$user['name']?></label></a>
						<?php endforeach; ?>
				</td>
				<td><a target="_blank" href="geo.php?lat=<?=$location ['lat']?>&lng=<?=$location['lng']?>&post_id=<?=$fetchPost['id']?>" class="btn btn-primary">Geo</a>
				<a href="index.php?nav=albums&post_id=<?=$fetchPost['id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-plus-sign"></span> Create Albums </a>
				<input type="checkbox" name="delete[]" value="<?=$fetchPost['id']?>">
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</form>