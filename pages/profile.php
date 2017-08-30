<?php 
	if (isset($_REQUEST['upload'])) {
		# code...
		$file  =$_FILES['f'];
		$size = $file['size'];
		$type = $file['type'];
		$name = $file['name'];
		$tmp = $file['tmp_name'];
		$folder="uploads/";
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
					if (mysqli_query($dbc,"UPDATE users SET pic='$rename' WHERE id='$fetchUser[id]'")) {
						# code...
						$msg="Successfully Uploaded";
						?>
						<script>
							setTimeout(function(){
								window.location="index.php?nav=profile";
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
<h1>User Profile</h1>
<hr>

<div class="row">
	<div class="col-sm-4">
		<form action="" enctype="multipart/form-data" method="post">
			<div class="form-group">
				<label for="">Upload Pic</label>
				<input type="file" class="form-control" name="f" data-target="#aImgShow" onChange="uploadImage(this)">
			</div>
			<button class="btn btn-primary" type="submit" name="upload">Upload</button>
		</form>
		<br>
		<p class="text-danger"><?=@$msg?></p>
	</div>
	<div class="col-sm-4">
		<img src="uploads/<?=$fetchUser['pic']?>" class="img img-thumbnail" height="180" width="180"  id="aImgShow"  alt="Default Pic">
	</div>
</div>