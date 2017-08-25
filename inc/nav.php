<?php if(!empty($_REQUEST['from_id']) AND !empty($_REQUEST['to_id'])): 
					mysqli_query($dbc,"UPDATE chat SET sts=1 WHERE from_id='$_REQUEST[to_id]'");
					 ?>
					<?php endif; ?>

<?php $get_nav = (!empty($_REQUEST['nav']))?$_REQUEST['nav']:"home"; $page = "pages/".$get_nav.".php";?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./">moixxweb</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
			<li><a href="public.php"><span class="glyphicon glyphicon-flag"></span> Public</a></li>
			<li><a href="feeds.php"><span class="glyphicon glyphicon-list"></span> New Feeds</a></li>
			</ul>
			<form class="navbar-form navbar-left" role="search">
			<a class="btn btn-primary" data-toggle="modal" href='#userSearchModal'>Search User</a>
			</form>
			<ul class="nav navbar-nav navbar-right">
			
				<?php if(isset($_SESSION['user_login'])): ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">
						<span class="glyphicon glyphicon-envelope"></span> <span id="msgNotification" class="badge">
					</span></a>
					</li>
					<li class="dropdown"><a href="index.php?nav=travelogue"><span class="glyphicon glyphicon-plane"></span> Travelogue</a></li>
					<li id="req_notify">

					</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<!-- Login User Image -->
					<img src="uploads/<?=$fetchUser['pic']?>" class='img img-rounded img-responsive pull-left' height="40" width="40" alt="..." style="margin-right: 10px">
					<?=$fetchUser['email'];?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="index.php?nav=profile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
					</ul>
				</li>
			<?php else: ?>
				<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			<?php endif; ?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>