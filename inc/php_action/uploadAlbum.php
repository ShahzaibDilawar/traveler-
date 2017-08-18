<?php session_start();
$dbc = mysqli_connect('localhost','root','','nascon_17'); ?>
<?php 
	if (!empty($_FILES)) {
		# code...
		$temp = $_FILES['file']['tmp_name'];
		$name = $_FILES['file']['name'];
		$folder= "uploads";
		$sep = DIRECTORY_SEPARATOR ;
		$ext = explode('.', $name);
		$ext = $ext[count($ext)-1];
		$rename = uniqid().rand().".".$ext;

		$path = "../../".$folder.$sep.$rename;

		if(mysqli_query($dbc,"INSERT INTO albums(pic,post_id) VALUES('$rename','$_SESSION[post_id]')")){
			if (move_uploaded_file($temp, $path)) {
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
	
		
		
		
	}
}
 ?>