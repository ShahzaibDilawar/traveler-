<?php 
include '../connect/db.php';
@$std_id = $fetchUser['id'];
	@$class  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE id='$std_id'"));

	@$update = "UPDATE group_chat SET sts=0 WHERE sts=1";
	@$update = mysqli_query($dbc,$update);
	if (@$update) {
		# code...
		$count = mysqli_num_rows(mysqli_query($dbc,"SELECT sts FROM group_chat WHERE sts=1"));
		if( $count!=0){echo $count;}; 
	}
?>