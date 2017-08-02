<?php include '../connect/db.php'; ?>
<?php echo "Read: ".mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM chat WHERE to_id='$fetchUser[id]' AND sts=0"))?>