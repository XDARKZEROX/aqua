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
	
	pjUtil::printNotice(__('infoAddCommenterTitle', true), __('infoAddCommenterDesc', true));
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionCreate" method="post" id="frmCreateMember" class="form pj-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="member_create" value="1" />
		
		<div class="clear_both">
			<p>
				<label class="title"><?php __('lblName'); ?></label>
				<span class="inline_block">
					<input type="text" name="name" id="name" class="pj-form-field w250 required" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblEmail'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-email"></abbr></span>
					<input type="text" name="email" id="email" class="pj-form-field required email w200" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblWebsite'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-url"></abbr></span>
					<input type="text" name="website" id="website" class="pj-form-field w200" placeholder="www.domain.com" value="" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblAvatar'); ?></label>
				<span class="inline_block">
					<input type="file" name="avatar" id="avatar" />
				</span>
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
				<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminMembers&action=pjActionIndex';" />
			</p>
		</div>
	</form>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.email_taken = "<?php __('pc_email_taken'); ?>";
	</script>
	<?php
}
?>