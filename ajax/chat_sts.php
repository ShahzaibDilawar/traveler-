<?php 
include '../connect/db.php';
	
$count = mysqli_num_rows(mysqli_query($dbc,"SELECT sts FROM group_chat WHERE sts=1"));

echo $count; ?>