<?php include '../connect/db.php'; ?>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="badge"><?php //echo mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM frnd_req WHERE to_id='$fetchUser[id]' AND sts=1"))?></span>
					</a>
						<ul class="dropdown-menu">
							<?php $q=mysqli_query($dbc,"SELECT * FROM frnd_req WHERE from_id<>'$fetchUser[id]' AND sts=1");
							while($r=mysqli_fetch_assoc($q)):
								$user = fetchById($dbc,"users",$r['from_id']);
							 ?>
							<li><a href="index.php?nav=user_profile&user_id=<?=$r['from_id']?>"><?=$user['name']?></a></li>
						<?php endwhile; ?>
						</ul>