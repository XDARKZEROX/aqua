<div id="pjWrapperPostComment_<?php echo $controller->getTopic();?>">

	<input type="hidden" id="pc_install_folder" name="install_folder" value="<?php echo PJ_INSTALL_FOLDER; ?>" />
	
	<div class="container-fluid pjCpContainer">
		<div class="row">
			<div class="col-md-12">
				<br>
				<?php
				include_once PJ_VIEWS_PATH . 'pjLoad/elements/comment_list.php';
				?>
				
				<div id="pjCpForm_<?php echo $controller->getTopic();?>" class="comment-form pjCpForm">
					<div class="container-fluid">
						<div class="row">
							<h4 class="pull-left pjCpFormTitle"><?php __('front_menu_forgot');?></h4>
	
							<p class="pull-right pjCpFormActions">
								<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogin<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_menu_login');?></a>
								<span>|</span>
								<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionRegister<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_menu_register');?></a> 
							</p>
						</div><!-- /.row -->
						
						<br>
	
						<p><?php __('front_forgot_text');?></p>
	
						<br>
	
						<div class="row">
							
							<form name="frmForgot" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionForgot<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>" method="post" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data">
								<input type="hidden" name="forgot_password" value="1" />
								
								<?php
								if(isset($_GET['err']))
								{
									$forgot_messages = __('front_forgot_message', true);
									?><div class="pjCpMessageContainer<?php echo $_GET['err'] == 'FF01' ? ' text-success' : 'text-danger';?>"><?php echo $forgot_messages[$_GET['err']]?></div><?php
								} 
								?>
								
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php __('front_label_email');?>:</label>
									
									<div class="col-sm-6">
										<input name="email" class="form-control" />
									</div>
								</div>
	
								<div id="pc-message-container" class="alert alert-danger pjCpErrorContainer" role="alert"></div>
	
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-6">
										<button type="submit" class="btn btn-default btn-lg pjCpBtn pjCpBtnPrimary" onclick="PC.Utils.submitForgot(event, 'frmForgot', 'pc-message-container'); return false;"><abbr></abbr><?php __('front_button_send');?></button>
										&nbsp;
										<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogin<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_label_cancel');?></a>
									</div>
								</div>
							</form>
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div><!-- /.comment-form pjCpForm -->
			</div><!-- /.col-md-10 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid pjCpContainer -->
</div><!-- /#pjWrapper -->

<script type="text/javascript">
var PC = PC || {};
PC.Msg = {};
<?php
foreach (__('front_error', true) as $k => $v)
{
	
	printf("PC.Msg.%s = '%s';\n", $k, addslashes($v));
	
}
?>
</script>