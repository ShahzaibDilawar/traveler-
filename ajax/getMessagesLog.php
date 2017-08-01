<?php include '../connect/db.php'; ?>
<?php 
$from_id=$_REQUEST['from_id'];
	$to_id=$_REQUEST['to_id'];
 		$getChat = mysqli_query($dbc,"SELECT * FROM chat  WHERE (from_id='$fetchUser[id]' AND to_id='$_REQUEST[to_id]') OR (to_id='$fetchUser[id]' AND from_id='$_REQUEST[to_id]')");
			while($fetchChat=mysqli_fetch_assoc($getChat)):
			$user = fetchById($dbc,"users",$fetchChat['indicator']);
			$align=($fetchChat['indicator']==$fetchUser['id'])?"right":'left';
			$bg=($fetchChat['indicator']==$fetchUser['id'])?"info":'warning';
			 ?>
			<!-- <p class="text-muted text-<?=$align?>"><?=ucwords($user['name'])?></p> -->
				<div data-toggle="tooltip" title="<?=$fetchChat['add_date']?>" data-placement="bottom" class="alert alert-sm text-<?=$align?> bg-<?=$bg?>"><?=$fetchChat['msg']?></div>
			
			<?php endwhile; ?>