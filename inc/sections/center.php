	<div class="panel panel-default">
				<?php if(!empty($_REQUEST['from_id']) AND !empty($_REQUEST['to_id'])): ?>

						<div class="panel-body" id="mychatBody">
						<?php $getChat = mysqli_query($dbc,"SELECT * FROM chat  WHERE (from_id='$fetchUser[id]' AND to_id='$_REQUEST[to_id]') OR (to_id='$fetchUser[id]' AND from_id='$_REQUEST[to_id]')");
						while($fetchChat=mysqli_fetch_assoc($getChat)):
						$user = fetchById($dbc,"users",$fetchChat['indicator']);
						$align=($fetchChat['indicator']==$fetchUser['id'])?"right":'left';
						$bg=($fetchChat['indicator']==$fetchUser['id'])?"info":'warning';

						 ?>
 							<!-- <p class="text-muted text-<?=$align?>"><?=ucwords($user['name'])?></p> -->

							<div data-toggle="tooltip" title="<?=$fetchChat['add_date']?>" data-placement="bottom" class="alert alert-sm text-<?=$align?> bg-<?=$bg?>"><?=$fetchChat['msg']?></div>
						<?php endwhile; ?>
						</div> <!-- body -->
					<div class="panel-footer">
						<form action="ajax/sendMessage.php" method="post" id="sendMessageForm">
							<textarea name="msg"  rows="4" placeholder="Type Message" class="form-control" id="msgTextarea" style="resize:none"></textarea>
							<input type="hidden" value="<?=@$_REQUEST['from_id']?>" id="from_id" name="from_id">
							<input type="hidden" value="<?=@$_REQUEST['to_id']?>" id="to_id" name="to_id">
							<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-send"></span></button>
						</form>
					</div>
				<?php else: ?>
					<p class="text-center text-muted">Select Conversation User</p>
					<?php endif; ?>
				</div> <!-- chat area -->

