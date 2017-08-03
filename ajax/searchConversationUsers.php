<?php include '../connect/db.php'; ?>
	<?php
	if (!empty($_REQUEST['data'])): 
		# code...
		$query = $_REQUEST['data'];
		 $q = mysqli_query($dbc,"SELECT * FROM users WHERE name LIKE '%$query%'");
					while($r=mysqli_fetch_assoc($q)):
						$chat = mysqli_query($dbc,"SELECT DISTINCT(to_id) FROM chat WHERE to_id='$r[id]'");
					while($chatR=mysqli_fetch_assoc($chat)):
						$user = fetchById($dbc,"users",$chatR['to_id']);
					 ?>
 						<a href="index.php?from_id=<?=$fetchUser['id']?>&to_id=<?=$chatR['to_id']?>" class="list-group-item">
	  						<img src="uploads/<?=$user['pic']?>" height="40" width="40" class="img img-circle img-responsive pull-left" alt="No Pic" style="margin-right: 10px">	
						    <h4 class="list-group-item-heading">
								<?=$user['name']?></h4>
								<!-- Fetching Last Message of User From Chat -->
								<?php //$userLast=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM chat WHERE from_id='$fetchUser[id]' AND to_id='$r[to_id]' ORDER BY id DESC")); ?>
						    <p class="list-group-item-text text-muted text-truncate"></p>
						  </a>
						<?php endwhile; 
							endwhile; 
						?>
					<?php else: ?>	
						<?php $q = mysqli_query($dbc,"SELECT DISTINCT(to_id) FROM chat WHERE from_id='$fetchUser[id]'");
					while($r=mysqli_fetch_assoc($q)):
						$user = fetchById($dbc,"users",$r['to_id']);
					 ?>
 						<a href="index.php?from_id=<?=$fetchUser['id']?>&to_id=<?=$user['id']?>" class="list-group-item">
	  						<img src="uploads/<?=$user['pic']?>" height="40" width="40" class="img img-circle img-responsive pull-left" alt="No Pic" style="margin-right: 10px">	
						    <h4 class="list-group-item-heading">
								<?=$user['name']?></h4>
								<!-- Fetching Last Message of User From Chat -->
								<?php $userLast=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM chat WHERE from_id='$fetchUser[id]' AND to_id='$r[to_id]' ORDER BY id DESC")); ?>
						    <p class="list-group-item-text text-muted text-truncate"><?=ucwords(substr($userLast['msg'],0,20))?></p>
						  </a>
						<?php endwhile; ?>
	<?php endif; ?>