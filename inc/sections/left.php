<div class="panel panel-default">
					<div class="panel-heading">
					<!-- <a href=""><span class="pull-left glyphicon glyphicon-cog"></span></a> -->
					<?php if(!empty($_REQUEST['from_id']) AND !empty($_REQUEST['to_id'])): 

					 ?>
					<li class="dropdown" style="list-style: none;">
						<a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown">
						<!-- Left Bar Cog Menu -->
						<span class="pull-left glyphicon glyphicon-cog"></span> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?from_id=<?=$_REQUEST['from_id']?>&to_id=<?=$_REQUEST['to_id']?>&action=deleteConversation">Delete Conversation</a></li>
						</ul>
					</li>
					<?php endif; ?>
					<center>Messenger</center>
					<a href="">	<span class="pull-right glyphicon glyphicon-edit" style="margin-top: -20px"></span></a>
					</div><!-- panel-heading -->
					<div class="panel-body"  style="height: 450px; overflow: scroll;">
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
						  <input type="text" id="search" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
						 </div> 
					</div><!-- Search Bar -->	
					<div class="list-group" id="getUserConversation">

					<?php
			
	# code...
					 $q = mysqli_query($dbc,"SELECT DISTINCT(to_id) FROM chat WHERE from_id='$fetchUser[id]'");
					 if(mysqli_num_rows($q)==0){echo "<p class='text-center text-muted'>No User in Conversation</p>";}
					 else{
					while($r=mysqli_fetch_assoc($q)):
						$user = fetchById($dbc,"users",$r['to_id']);
					 ?>
 						<a href="index.php?from_id=<?=$fetchUser['id']?>&to_id=<?=$user['id']?>" class="list-group-item">
 						
 						 <span class="badge" id="msgNotificationSide">
						Read

					</span>
	  						<img src="uploads/<?=$user['pic']?>" height="40" width="40" class="img img-circle img-responsive pull-left" alt="No Pic" style="margin-right: 10px">	
						    <h4 class="list-group-item-heading">
								<?=$user['name']?></h4>
								<!-- Fetching Last Message of User From Chat -->
								<?php $userLast=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM chat WHERE (from_id='$fetchUser[id]' AND to_id='$r[to_id]') ORDER BY id DESC")); ?>
						    <p class="list-group-item-text text-muted text-truncate"><?=ucwords(substr($userLast['msg'],0,20))?></p>

						  </a>
						<?php endwhile; 
						} //else close?>
					</div>	<!-- List of Users -->
					</div><!-- panel-body -->
				</div><!-- panel panel-default -->