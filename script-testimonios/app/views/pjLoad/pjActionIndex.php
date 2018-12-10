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
							<h4 class="pull-left pjCpFormTitle"><?php __('front_label_leave_comment');?></h4>
	
							<p class="pull-right pjCpFormActions">
								<?php
								if($controller->checkLogin())
								{ 
									?>
									<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogout<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><?php __('front_menu_logout');?></a>
									<span>|</span> 
									<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionMyProfile<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_menu_my_profile');?></a>
									<?php
								}else{
									?>
									<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogin<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_menu_login');?></a>
									<span>|</span>
									<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionRegister<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>#pjCpForm_<?php echo $controller->getTopic();?>"><?php __('front_menu_register');?></a>
									<?php
								} 
								?>
							</p>
						</div><!-- /.row -->
						
						<br>
						
						<div class="row">
							<form name="frmPostComment" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionIndex<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>" method="post" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data">
								<input type="hidden" name="post_comment" value="1" />
								<input type="hidden" name="topic_id" value="<?php echo $tpl['topic_id']?>" />
								
								<?php
								if(isset($_GET['err']))
								{
									$post_messages = __('front_postcomment', true);
									?><div class="pjCpMessageContainer<?php echo in_array($_GET['err'], array('FPC01', 'FPC04', 'FPC05')) ? ' text-success' : ' text-danger';?>"><?php echo $post_messages[$_GET['err']]?></div><?php
								} 
								
								if($tpl['option_arr']['o_allow_topic_rating'] == 'Yes')
								{
									?>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php __('front_label_rate');?>:</label>
										<input type="hidden" id="rating_value" name="rating" value="" />
										<div class="col-sm-6 pjCpFormRating">
											<a id="star_1" href="#" class="pc-star" lang="1"><span class="glyphicon glyphicon-star-empty"></span></a>
											<a id="star_2" href="#" class="pc-star" lang="2"><span class="glyphicon glyphicon-star-empty"></span></a>
											<a id="star_3" href="#" class="pc-star" lang="3"><span class="glyphicon glyphicon-star-empty"></span></a>
											<a id="star_4" href="#" class="pc-star" lang="4"><span class="glyphicon glyphicon-star-empty"></span></a>
											<a id="star_5" href="#" class="pc-star" lang="5"><span class="glyphicon glyphicon-star-empty"></span></a>
										</div>
									</div>
									<?php
								}
								if(!$controller->checkLogin())
								{
									?>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php __('front_label_name');?>:</label>
										
										<div class="col-sm-6">
											<input type="text" class="form-control" name="name">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php __('front_label_email');?>:</label>
										
										<div class="col-sm-6">
											<input type="text" class="form-control" name="email">
										</div>
									</div>
									<?php
								} 
								?>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php __('front_label_comment');?>:</label>
									
									<div class="col-sm-8">
										<textarea name="comment_text" class="form-control" cols="30" rows="10"></textarea>
									</div>
								</div>
								<?php
								if($tpl['option_arr']['o_allow_topic_subscribing'] == 'Yes')
								{
									?>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php __('front_label_subscribe');?>:</label>
										
										<div class="col-sm-6 pjCpCheckbox">
											<input type="checkbox" name="subscribed" type="checkbox" value="1" >
										</div>
									</div>
									<?php
								}
								if($tpl['option_arr']['o_allow_file_uploading'] == 'Yes')
								{
									?>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php __('front_label_upload_file');?>:</label>
										
										<div class="col-sm-6 pjCpUpload">
											<input type="file" name="file">
										</div>
									</div>
									<?php
								}
								if(!$controller->checkLogin())
								{
									?>
									<div class="form-group pjCrCaptcha">
										<label for="inputPassword" class="control-label col-sm-2 col-xs-12"><?php __('front_label_verification');?>: </label>
										
										<div class="col-sm-2 col-xs-6">
											<input type="text" class="form-control" name="verification" id="verification" maxlength="6" autocomplete="off">
										</div>
										
										<div class="col-sm-2 col-xs-6">
											<img src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;rand=<?php echo rand(1, 999999); ?>" alt="CAPTCHA" style="vertical-align: middle" />
										</div>
									</div><!-- /.form-group -->
									<?php
								} 
								?>
								
								<div id="pc-message-container" class="alert alert-danger pjCpErrorContainer" role="alert"></div>
								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-6">
										<button type="submit" class="btn btn-default btn-lg pjCpBtn pjCpBtnPrimary" onclick="PC.Utils.postComment(event, 'frmPostComment', 'pc-message-container', this); return false;"><abbr></abbr><?php __('front_button_add_comment');?></button>
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
$banned_words = trim($tpl['option_arr']['o_banned_words']);
foreach (__('front_error', true) as $k => $v)
{
	printf("PC.Msg.%s = '%s';\n", $k, addslashes($v));	
}
?>
PC.allowed_ext = "<?php echo $tpl['option_arr']['o_file_allowed'];?>";
PC.banned_words = "<?php echo $banned_words;?>";
</script>