<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
} else {
	$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	
	pjUtil::printNotice(__('infoUpdateCommenterTitle', true), __('infoUpdateCommenterDesc', true));
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionUpdate" method="post" id="frmUpdateMember" class="form pj-form" enctype="multipart/form-data">
		<input type="hidden" name="member_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		
		<div class="clear_both">
			<p>
				<label class="title"><?php __('lblMemberSince'); ?></label>
				<span class="inline_block">
					<label class="content"><?php echo !empty($tpl['arr']['first_comment']) ? date($tpl['option_arr']['o_date_format'], strtotime($tpl['arr']['first_comment'])) . ', ' . date($tpl['option_arr']['o_time_format'], strtotime($tpl['arr']['first_comment'])) : __('lblNA', true)?></label>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblTotalComments'); ?></label>
				<span class="inline_block">
					<?php
					if($tpl['arr']['cnt_comments'] > 0)
					{ 
						?>
						<label class="content"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionIndex&amp;member_id=<?php echo $tpl['arr']['id']; ?>"><?php echo $tpl['arr']['cnt_comments'];?></a></label>
						<?php
					}else{
						?>
						<label class="content"><?php echo $tpl['arr']['cnt_comments'];?></label>
						<?php
					} 
					?>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblName'); ?></label>
				<span class="inline_block">
					<input type="text" name="name" id="name" class="pj-form-field w250 required" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['name'])); ?>" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblEmail'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-email"></abbr></span>
					<input type="text" name="email" id="email" class="pj-form-field required email w200" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['email'])); ?>"  />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblPass'); ?></label>
				<span class="inline_block">
					<input type="text" name="password" id="password" class="pj-form-field w250 required" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['password'])); ?>" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblWebsite'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-url"></abbr></span>
					<input type="text" name="website" id="website" class="pj-form-field w200" placeholder="www.domain.com" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['website'])); ?>"  />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblAvatar'); ?></label>
				<span class="inline_block">
					<input type="file" name="avatar" id="avatar" />
				</span>
			</p>
			<?php
			if(!empty($tpl['arr']['avatar_path']))
			{
				$avatar_path =  $tpl['arr']['avatar_path'];
				if (file_exists(PJ_INSTALL_PATH . $avatar_path)) 
				{
					$avatar_url = PJ_INSTALL_URL . $avatar_path;
					?>
					<p id="avatar_container">
						<label class="title">&nbsp;</label>
						<span class="inline_block">
							<img src="<?php echo $avatar_url;?>" />
							<a class="icon-remove" href="javascript:void(0);" rev="<?php echo $tpl['arr']['id'];?>"></a>
						</span>
					</p>
					<?php
				}
			} 
			?>
			<p>
				<label class="title"><?php __('lblStatus'); ?></label>
				<span class="inline_block">
					<select name="status" id="status" class="pj-form-field required">
						<option value="">-- <?php __('lblChoose'); ?>--</option>
						<?php
						foreach (__('u_statarr', true) as $k => $v)
						{
							?><option value="<?php echo $k; ?>"<?php echo $k == $tpl['arr']['status'] ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
						}
						?>
					</select>
				</span>
			</p>
			
			
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminMembers&action=pjActionIndex';" />
			</p>
		</div>
	</form>
	<div id="dialogDeleteAvatar" title="<?php __('lblDeleteAvatarTitle'); ?>" style="display:none;">
		<div class="t15">
			<?php __('lblDeleteAvatarConfirmation'); ?>
			<input type="hidden" id="record_id" name="record_id" value="" />
		</div>
	</div>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.email_taken = "<?php __('pc_email_taken'); ?>";
	</script>
	<?php
}
?>