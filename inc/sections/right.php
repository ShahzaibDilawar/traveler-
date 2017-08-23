	<div class="panel panel-default">
				<?php if(!empty($to_id['name'])): ?>
					<div class="panel-heading" style="padding: 2px;">
					<img src="uploads/<?=@$to_id['pic']?>" height="40" width="40" class="img img-circle img-responsive pull-left" alt="No Pic" style="margin-right: 10px"> 
					<b>
						<?=@ucwords($to_id['name'])?>
					<br> <i style="font-weight: 300;font-size: 11px">ChatApp</i></b> 
					<div class="btn-group pull-right" style="margin-top: -20px">
						<a href="" class="btn btn-md btn-defaullt"><span class="glyphicon glyphicon-cog"></span></a>
					</div>

					</div><!-- panel-heading -->
					<?php endif; ?>
					<div class="panel-body">
						<p class="text-muted">Profile URL</p>
						<a href="">http://www.moixxweb.com/<?=@$to_id['name']?></a>
					</div>
					<hr>
					
					<div class="list-group">
					<li class="list-group-item disabled">Friend List</li>
					<?php $q = mysqli_query($dbc,"SELECT * FROM frndlst WHERE user1<>'$fetchUser[id]'");
						$count = mysqli_num_rows($q);
						while($r=mysqli_fetch_assoc($q)):
						$user = fetchById($dbc,"users",$r['user1']);

					 ?>
						<a href="index.php?nav=user_profile&user_id=<?=$r['user1']?>" class="list-group-item"><?=ucwords($user['name'])?></a>
					<?php endwhile; ?>
					<li class="list-group-item disabled">Total Frieds : <?=@$count;?></li>


					</div>
				</div>