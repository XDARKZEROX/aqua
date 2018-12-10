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
	pjUtil::printNotice(__('infoAddUserTitle', true, false), __('infoAddUserDesc', true, false));
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminUsers&amp;action=pjActionCreate" method="post" id="frmCreateUser" class="form pj-form" autocomplete="off">
		<input type="hidden" id="action_name" name="user_create" value="1" />
		<p>
			<label class="title"><?php __('lblRole'); ?></label>
			<span class="inline_block">
				<select name="role_id" id="role_id" class="pj-form-field required">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach ($tpl['role_arr'] as $v)
					{
						?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['role']); ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title"><?php __('email'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-email"></abbr></span>
				<input type="text" name="email" id="email" class="pj-form-field required email w200" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('pass'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-password"></abbr></span>
				<input type="text" name="password" id="password" class="pj-form-field required w200" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblName'); ?></label>
			<span class="inline_block">
				<input type="text" name="name" id="name" class="pj-form-field w250 required" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblPhone'); ?></label>
			<span class="inline_block">
				<input type="text" name="phone" id="phone" class="pj-form-field w250" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblNotifyEmail'); ?></label>
			<span id="boxEmail">
				<select id="notify_email" name="notify_email[]" multiple="multiple" class="w400" data-placeholder="<?php __('lblChoose'); ?>">
				<?php
				foreach (__('notify_email', true) as $k => $v)
				{
					if($k == 4)
						continue;
					?><option value="<?php echo $k; ?>" <?php echo $k == 1 ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
				}
				?>
				</select>
			</span>
			<a href="#" class="pj-form-langbar-tip pc-tip" title="<?php __('lblNotifyEmailTip'); ?>"></a>
		</p>
		<p>
			<label class="title"><?php __('lblNotifySms'); ?></label>
			<span id="boxSms">
				<select id="notify_sms" name="notify_sms[]" multiple="multiple" class="w400" data-placeholder="<?php __('lblChoose'); ?>">
				<?php
				foreach (__('notify_sms', true) as $k => $v)
				{
					?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
				}
				?>
				</select>
			</span>
			<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblUserSmsTip'); ?>"></a>
		</p>
		<p>
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('u_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminUsers&action=pjActionIndex';" />
		</p>
	</form>
	
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.email_taken = "<?php __('pc_email_taken'); ?>";
	</script>
	<?php
}
?>