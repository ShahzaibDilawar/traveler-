
<?php 
	
	include '../connect/db.php';
	
		$select = mysqli_query($dbc,"SELECT * FROM group_chat ORDER BY id DESC");
		while ($ext = mysqli_fetch_assoc($select)) {
		# code...
			$idd = $ext['std_id'];
				$std = fetchById($dbc,"users",$idd);

		?>
		
		<div style="font-size:14px;" title="<?php echo $ext['msg_time'];?>" class="chat_msg_response">
		<i><?=$std['name']?></i><br>
		 <?php echo htmlspecialchars(stripslashes($ext['msg']))."<p style='font-size:9px;float:right;margin:10px 10px 0 0'>".$ext['msg_date']."</p>"; ?></div>
		
	<?php 
} //while
	
	
	
 ?>
