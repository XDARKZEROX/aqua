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
	
	pjUtil::printNotice(__('infoUpdatePageTitle', true), __('infoUpdatePageDesc', true));
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminTopics&amp;action=pjActionUpdate" method="post" id="frmUpdateTopic" class="form pj-form">
		<input type="hidden" name="topic_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<p>
			<label class="title"><?php __('menuComments'); ?></label>
			<label class="content">
				<?php
				if($tpl['arr']['cnt_comments'] > 0)
				{ 
					?>
					<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionIndex&topic_id=<?php echo $tpl['arr']['id'];?>"><?php echo $tpl['arr']['cnt_comments'];?></a>
					<?php
				}else{
					echo $tpl['arr']['cnt_comments'];
				} 
				?>
			</label>
		</p>
		<?php
		if(isset($tpl['last_arr']))
		{ 
			?>
			<p>
				<label class="title"><?php __('lblLastComment'); ?></label>
				<label class="content">
					<?php echo date($tpl['option_arr']['o_date_format'], strtotime($tpl['last_arr']['created'])) ;?>, <?php echo date($tpl['option_arr']['o_time_format'], strtotime($tpl['last_arr']['created'])) ;?> <?php __('lblBy');?> <?php echo pjSanitize::html($tpl['last_arr']['name']);?>
				</label>
			</p>
			<?php
		} 
		?>
		<p>
			<label class="title"><?php __('lblPageURL'); ?></label>
			<span class="inline_block">
				<span class="pj-form-field-custom pj-form-field-custom-before block float_left r5">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-url"></abbr></span>
					<input type="text" name="page_url" id="page_url" class="pj-form-field w400 required pageurl" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['page_url'])); ?>"  placeholder="http://www.domain.com" data-msg-required="<?php __('lblFieldRequired');?>" data-msg-pageurl="<?php __('lblPageURLInvalid'); ?>"/>
				</span>
				<a class="pjPcPreview" href="<?php echo htmlspecialchars(stripslashes($tpl['arr']['page_url'])); ?>" target="_blank"></a>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblReferenceID'); ?></label>
			<span class="inline_block">
				<input type="text" name="topic" id="topic" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['topic'])); ?>" class="pj-form-field w150 required refid" data-msg-required="<?php __('lblFieldRequired');?>" data-msg-refid="<?php __('lblReferenceIDAllowed'); ?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>">
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
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminTopics&action=pjActionIndex';" />
		</p>
	</form>
	<?php
}
?>