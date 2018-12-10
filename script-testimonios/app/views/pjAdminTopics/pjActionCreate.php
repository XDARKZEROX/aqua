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
	
	pjUtil::printNotice(__('add_topic_titles_title', true), __('add_topic_titles_body', true)); 
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminTopics&amp;action=pjActionCreate" method="post" id="frmCreateTopic" class="form pj-form" autocomplete="off">
		<input type="hidden" name="topic_create" value="1" />
		<p>
			<label class="title"><?php __('lblPageURL'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-url"></abbr></span>
				<input type="text" name="page_url" id="page_url" class="pj-form-field w400 required pageurl" placeholder="http://www.domain.com" data-msg-required="<?php __('lblFieldRequired');?>" data-msg-pageurl="<?php __('lblPageURLInvalid'); ?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblReferenceID'); ?></label>
			<span class="inline_block">
				<input type="text" name="topic" id="topic" class="pj-form-field w150 required refid" data-msg-required="<?php __('lblFieldRequired');?>" data-msg-refid="<?php __('lblReferenceIDAllowed'); ?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>" >
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('u_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $k == 'T' ? ' selected="selected"' : null;?>><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminTopics&action=pjActionIndex';" />
		</p>
	</form>
	<?php
}
?>