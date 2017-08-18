<?php 
	if (isset($_REQUEST['save'])) {
		# code...
		$file  =$_FILES['f'];
		$size = $file['size'];
		$type = $file['type'];
		$name = $file['name'];
		$tmp = $file['tmp_name'];
		$title =mysqli_real_escape_string($dbc,strip_tags($_REQUEST['title']));
		$description =mysqli_real_escape_string($dbc,strip_tags($_REQUEST['description']));
		@$along=$_REQUEST['along'];
		$alongs="";
		if (!empty(@$along)) {
			# code...
			foreach($along as $val){
			$alongs.=$val.",";
		}
		}
		
		$folder="post_uploads/";
		if (!$tmp) {
			# code...
			$msg="Please Choose a File First";
		}else{
			$ext = explode('.', $name);
			// echo "<pre>";
			// print_r($ext);
			// echo "</pre>";
			$ext = $ext[count($ext)-1];
			// echo "<h1>".$ext."</h1>";
			if ($ext!="png" AND $ext!="jpg" AND $ext!="jpeg") {
				# code...
				$msg="Only .jpg , .png and .jpeg Allowed";
			}else{
				$rename = uniqid().rand().".".$ext;
				if(move_uploaded_file($tmp, $folder.$rename)){
					if (mysqli_query($dbc,"INSERT INTO post(title,description,pic,user_id,trip_id,cat_id,along) VALUES('$title','$description','$rename','$fetchUser[id]','$_REQUEST[trip_id]','$_REQUEST[cat_id]','$alongs')")) {
						# code...
						$msg="Successfully Uploaded Post";
						?>
						<script>
							setTimeout(function(){
								window.location="index.php?nav=experience";
							},1000);
						</script>
						<?php
					}else{
						$msg=mysqli_error($dbc);
					}//query update
				}else{
						$msg="Probelm While Uploading";
					}//uploaded move
			}
		}
	}
 ?>
