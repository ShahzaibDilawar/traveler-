<?php include '../connect/db.php'; ?>
<?php 
	$lat = mysqli_real_escape_string($dbc,strip_tags($_REQUEST['lat']));

	$lng = mysqli_real_escape_string($dbc,strip_tags($_REQUEST['lng']));
	$name = mysqli_real_escape_string($dbc,strip_tags($_REQUEST['name']));
	if ($lng AND $lat AND $name) {
		# code...

			if (mysqli_query($dbc,"INSERT INTO location(lat,lng) VALUES('$lat','$lng')")) {
				$fetchLocation = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM location ORDER BY id DESC LIMIT 1"));
				if (!empty($fetchLocation['id'])) {
					# code...
					$add_date = date('Y-m-d');
					if (mysqli_query($dbc,"INSERT INTO trip(name,location_id,user_id,add_date) VALUES('$name','$fetchLocation[id]','$fetchUser[id]','$add_date')")) {
				# code...
				$msg = $name." has successfully Registered....";
				$sts = "success";
			}
				else{
					$msg = mysqli_error($dbc);
					$sts = "danger";
				}
				}//!empty
			}
		
			
	}
		echo "<div class='alert alert-{$sts}'>{$msg}</div>";


 ?>