<?php if(!empty($_REQUEST['from_id']) AND !empty($_REQUEST['to_id']) AND @$_REQUEST['action']=='deleteConversation'){
	if (mysqli_query($dbc,"DELETE FROM chat WHERE (from_id='$_REQUEST[from_id]' AND to_id='$_REQUEST[to_id]') OR (from_id='$_REQUEST[to_id]' AND to_id='$_REQUEST[from_id]') ")) {
		# code...
		$msg="Conversation Deleted";
		$sts="danger";
		?>
		<script>
			setTimeout(function(){
				window.location="index.php";
			},1500);
		</script>
		<?php
	}else{

		$msg=mysqli_error($dbc);
		$sts="danger";
	}

}

?>

<?php if(!empty($_REQUEST['from_id']) AND !empty($_REQUEST['to_id'])){
					$to_id = fetchById($dbc,'users',$_REQUEST['to_id']);
				}
					 ?>

