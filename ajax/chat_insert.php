
<?php 
	
	include '../connect/db.php';
	@$msg = $_REQUEST['msg'];
	@$msg = mysqli_real_escape_string($dbc,addslashes($msg));
	date_default_timezone_set("Indian/Maldives");
	@$std_id = $fetchUser['id'];

		@$time = date("h:i:sa");
		@$date = date('d-M-Y');
		@$std = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE id='$fetchUser[id]'"));
		$q = "INSERT INTO group_chat(std_id,msg,msg_date,msg_time,sts) VALUES('$std_id','$msg','$date','$time','1')";
		@$r  =mysqli_query($dbc,$q);

	if ($r) {
		
		$select = mysqli_query($dbc,"SELECT * FROM group_chat ORDER BY id DESC");
		while ($ext = mysqli_fetch_assoc($select)) {
		# code...
			$idd = $ext['std_id'];
		?>
		<div style="font-size:14px;" title="<?php echo $ext['msg_time'];?>" class="chat_msg_response">
		<img src="../img/default-user.png" width='25px' height='25px' align="top" > 
		 <?php echo htmlspecialchars(stripslashes($ext['msg']))."<p style='font-size:9px;float:right'>".$ext['msg_date']."</p>"; ?></div>
		
	<?php 
} //while
	
	}
	else{
		echo "problem in query";
	}
	
 ?>