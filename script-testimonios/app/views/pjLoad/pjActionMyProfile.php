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
							<h4 class="pull-left pjCpFormTitle"><?php __('front_menu_my_profile');?></h4>
	
							<p class="pull-right pjCpFormActions">
								<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogout<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_menu_logout');?></a> 
							</p>
						</div><!-- /.row -->
						
						<br>
	
						<p><?php __('front_my_profile_text');?></p>
	
						<br>
	
						<div class="row">
							<form name="frmMyProfile" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionMyProfile<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>" method="post" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data">
								<input type="hidden" name="update_profile" value="1" />
								<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
								
								<?php
								if(isset($_GET['err']))
								{
									$profile_messages = __('front_profile_message', true);
									?><div class="pjCpMessageContainer<?php echo $_GET['err'] == 'FP01' ? ' text-success' : 'text-danger';?> pc-b20"><?php echo $profile_messages[$_GET['err']]?></div><?php
								} 
								?>
								
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php __('front_label_name');?>:</label>
									
									<div class="col-sm-6">
										<input name="name" class="form-control" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['name'])); ?>"/>
									</div>
								</div>
	
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php __('front_label_email');?>:</label>
									
									<div class="col-sm-6">
										<input name="email" class="form-control" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['email'])); ?>"/>
									</div>
								</div>
	
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php __('front_label_website');?>:</label>
									
									<div class="col-sm-6">
										<input type="text" name="website" class="form-control" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['website'])); ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php __('front_label_avatar');?>:</label>
									
									<div class="col-sm-6">
										<input type="file" name="avatar"/>
									</div>
								</div>
								<?php
								if(!empty($tpl['arr']['avatar_path']))
								{
									$avatar_path =  $tpl['arr']['avatar_path'];
									if (file_exists(PJ_INSTALL_PATH . $avatar_path)) 
									{
										$avatar_url = PJ_INSTALL_URL . $avatar_path;
										?>
										<div id="pc_avatar_container">
											<div class="form-group">
												<label class="col-sm-2 control-label">&nbsp;</label>
												
												<div class="col-sm-6">
													<img class="pc-avatar" src="<?php echo $avatar_url;?>" />
													<a href="javascript:void(0);" onclick="PC.Utils.removeAvatar(event, '<?php echo $tpl['arr']['id'];?>', 'pc_avatar_container'); return false;"><span class="glyphicon glyphicon-remove"></span>&nbsp;<?php __('front_label_remove');?></a>
												</div>
											</div>
										</div>
										<?php
									}
								} 
								?>
								<div id="pc-message-container" class="alert alert-danger pjCpErrorContainer" role="alert"></div>
	
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-6">
										<button type="submit" class="btn btn-default btn-lg pjCpBtn pjCpBtnPrimary" onclick="PC.Utils.updateProfile(event, 'frmMyProfile', 'pc-message-container'); return false;"><abbr></abbr><?php __('front_button_update');?></button>
										&nbsp;
										<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionIndex<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_label_cancel');?></a>
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