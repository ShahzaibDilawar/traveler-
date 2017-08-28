<?php if(!empty($_REQUEST['from_id']) AND !empty($_REQUEST['to_id'])): ?>
	<?php $fetchToUser = fetchById($dbc,"users",$_REQUEST['to_id']); ?>
	<?php if (isset($_REQUEST['send'])) {
		# code...
		if (mysqli_query($dbc,"INSERT INTO chat(from_id,indicator,to_id,msg) VALUES('$_REQUEST[from_id]','$_REQUEST[from_id]','$_REQUEST[to_id]','$_REQUEST[msg]')")) {
			# code...
			$msg = "Message has been Sent";
			$sts="success";
			?>
			<script>
				setTimeout(function(){
					window.location="index.php?from_id=<?php echo $_REQUEST['from_id']?>&to_id=<?php echo $_REQUEST['to_id']?>";
				},1500);
			</script>
			<?php
		}else{
			$msg=mysqli_error($dbc);
			$sts="danger";
		}
	} ?>
	<?php getMessage(@$msg,@$sts); ?>
	<div class="row">
		<div class="col-sm-12">
			<form action="" method="post">
				<div class="form-group">
					<label for="">Name or Email </label>
					<input type="text" disabled class="form-control" value="<?=@$fetchToUser['email']?>">
				</div>
				<div class="form-group">
					<label for="">Type Message</label>
					<textarea name="msg" class="form-control" placeholder="Type Message" cols="30" rows="10" required></textarea>
				</div>
				<button name="send" class="btn btn-success"><span class="glyphicon glyphicon-send"></span> Send</button>
			</form>
		</div>
	</div>
<?php endif; ?>
