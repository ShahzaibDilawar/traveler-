<?php include 'inc/php_action/deleteUserConversation.php'; ?>
<?php getMessage(@$msg,@$sts); ?>
<div class="panel panel-default">
	<div class="panel-heading" style="padding: 0px">
		<center>
			<b><?php if(!empty($to_id['name'])): ?>
						<?=@ucwords($to_id['name'])?>
					<?php endif; ?></b>
			<p class="text-muted">ChatApp</p>
		</center>
		<div class="btn-group pull-right" style="margin-top: -50px">
			<a href="" class="btn btn-md btn-defaullt"><span class="glyphicon glyphicon-phone"></span></a>
			<a href="" class="btn btn-md btn-defaullt"><span class="glyphicon glyphicon-camera"></span></a>
			<a href="" class="btn btn-md btn-defaullt"><span class="glyphicon glyphicon-info-sign"></span></a>
		</div>
	</div><!-- panel-heading  -->
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-3 hidden-sm" style="height: 500px;border-right: 1px solid #eee;">
				<?php include 'inc/sections/left.php'; ?>
			</div><!-- Left -->
			<div class="col-sm-6">
				<?php include 'inc/sections/center.php'; ?>
			</div><!-- Center -->
			<div class="col-sm-3" style="height: 500px;border-left: 1px solid #eee;">
				<?php include 'inc/sections/right.php'; ?>
			</div><!-- Right -->
		</div>
	</div><!-- panel -body -->
</div><!-- panel panel-default -->


