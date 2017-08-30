<?php if(!empty($_REQUEST['user_id'])):

$user = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE id='$_REQUEST[user_id]'"));
$checkFriend = mysqli_query($dbc,"SELECT id FROM frndlst WHERE(user1='$fetchUser[id]' AND user2='$_REQUEST[user_id]') OR (user1='$_REQUEST[user_id]' AND user2='$fetchUser[id]')");
if (mysqli_num_rows($checkFriend)==1) {
	# code...
	$link = "<a class='btn btn-sm btn-danger' href='index.php?nav=user_profile&user_id=$_REQUEST[user_id]&action=unfreind'>Unfreind</a>";
}else{
$from_query = mysqli_query($dbc,"SELECT id FROM frnd_req WHERE from_id='$_REQUEST[user_id]' AND to_id='$fetchUser[id]'");
$to_query = mysqli_query($dbc,"SELECT id FROM frnd_req WHERE to_id='$_REQUEST[user_id]' AND from_id='$fetchUser[id]'");
	if (mysqli_num_rows($from_query)==1) {
		# code...
		$link ="<a class='btn btn-sm btn-primary' href='index.php?nav=user_profile&user_id=$_REQUEST[user_id]&action=accept'>Accept Request</a>";
	}elseif(mysqli_num_rows($to_query)==1){
		$link="<a class='btn btn-sm btn-danger' href='index.php?nav=user_profile&user_id=$_REQUEST[user_id]&action=cancel'>Cancel Request</a>";
	}else{
		$link="<a class='btn btn-sm btn-success' href='index.php?nav=user_profile&user_id=$_REQUEST[user_id]&action=send'>Sent Request</a>";
	}
}//chck else

?>


		<!-- Actions -->

	<?php if(!empty($_REQUEST['action'])): ?>
		<!-- Sent Request -->
	<?php if ($_REQUEST['action']=='send') {
		# code...
		mysqli_query($dbc,"INSERT INTO frnd_req(from_id,to_id) VALUES('$fetchUser[id]','$_REQUEST[user_id]')");

	} ?>
	<!-- Cancel Request -->
	<?php if ($_REQUEST['action']=='cancel') {
		# code...
		mysqli_query($dbc,"DELETE FROM frnd_req WHERE from_id='$fetchUser[id]' AND to_id='$_REQUEST[user_id]'");
	} ?>
	<!-- Accepts Request -->
	<?php if ($_REQUEST['action']=='accept') {
		# code...
		mysqli_query($dbc,"DELETE FROM frnd_req WHERE to_id='$fetchUser[id]' AND from_id='$_REQUEST[user_id]'");
		mysqli_query($dbc,"INSERT INTO frndlst(user2,user1) VALUES('$_REQUEST[user_id]','$fetchUser[id]')");
	} ?>
	<?php if ($_REQUEST['action']=='unfreind') {
		# code...
			mysqli_query($dbc,"DELETE FROM frndlst WHERE(user1='$fetchUser[id]' AND user2='$_REQUEST[user_id]') OR (user1='$_REQUEST[user_id]' AND user2='$fetchUser[id]')");
	} ?>
	<script>
		setTimeout(function(){
			window.location="index.php?nav=user_profile&user_id=<?php echo $_REQUEST['user_id']?>";
		},1500);
	</script>
<?php endif; ?>


<div class="row">
	<div class="col-sm-3">
		<img src="uploads/<?=$user['pic'];?>" width="100" height="100" class="img img-rounded img-responsive" alt="">
	</div>
	<div class="col-sm-9">
		<table class="table table-condensed table-bordered">
		<tr>
			<th colspan="100">
			<?=$link; ?>
			</th>
		</tr>
			<tr>
				<th>Name</th>
				<td><?=$user['name'];?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?=$user['email'];?></td>
			</tr>
		</table>
	</div>
</div>
<?php endif; ?>