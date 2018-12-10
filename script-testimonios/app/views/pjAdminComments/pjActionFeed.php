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
	if (isset($_GET['err']))
	{
		$titles = __('error_titles', true);
		$bodies = __('error_bodies', true);
		pjUtil::printNotice(@$titles[$_GET['err']], @$bodies[$_GET['err']]);
	}
	
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionIndex"><?php __('menuComments'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionFeed"><?php __('lblExportFeed'); ?></a></li>
		</ul>
	</div>
	
	<?php
	
	pjUtil::printNotice(__('lblExportFeed', true), __('infoXMLFeedDesc', true));
	
	$export_formats = __('export_formats', true, false);
	$export_periods = __('export_periods', true, false);
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionFeed" method="post" id="frmXMLFeed" class="form pj-form">
		<input type="hidden" name="comment_feed" value="1" />
		<p>
			<label class="title"><?php __('lblPage'); ?></label>
			<span class="inline_block">
				<select name="topic_id" id="topic_id" class="pj-form-field w150">
					<option value="">-- <?php __('lblAllPages');?> --</option>
					<?php
					foreach($tpl['topic_arr'] as $v)
					{
						?><option value="<?php echo $v['id']?>"<?php echo (isset($_POST['topic_id']) && $_POST['topic_id'] == $v['id']) || (isset($_GET['topic_id']) && $_GET['topic_id'] == $v['id']) ? ' selected="selected"' : null; ?>><?php echo pjSanitize::html($v['topic']);?></option><?php
					} 
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblFormat'); ?></label>
			<span class="inline_block">
				<select name="format" id="format" class="pj-form-field w100">
					<?php
					foreach ($export_formats as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo isset($_POST['format']) && $_POST['format'] == $k ? ' selected="selected"' : null; ?>><?php echo pjSanitize::html($v); ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblEnterPassword');?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-password"></abbr></span>
				<input type="text" id="feed_password" name="password" class="pj-form-field w200 required" value="<?php echo isset($_POST['password']) ? $_POST['password'] : null; ?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblPeriod'); ?></label>
			<span class="inline_block">
				<select name="period" id="period" class="pj-form-field w150">
					<?php
					foreach(__('peirod_arr', true) as $k => $v)
					{
						?><option value="<?php echo $k;?>"<?php echo isset($_POST['period']) ? ($_POST['period'] == $k ? ' selected="selected"' : null) : null; ?>><?php echo $v;?></option><?php 
					} 
					?>
				</select>
			</span>
		</p>
		
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" id="tsSubmitButton" value="<?php __('btnGetFeedURL'); ?>" class="pj-button" />
		</p>
		<?php
		if(isset($_POST['comment_feed'])) 
		{
			?>
			<div class="tsFeedContainer">
				<br/>
				<?php pjUtil::printNotice(__('infoCommentsFeedTitle', true), __('infoCommentsFeedDesc', true)); ?>
				<span class="inline_block">
					<textarea name="comments_feed" class="pj-form-field h80" style="width: 726px;"><?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminComments&amp;action=pjActionExportFeed<?php echo !empty($_POST['topic_id']) ? '&topic_id=' . $_POST['topic_id'] : null;?>&amp;format=<?php echo$_POST['format']; ?>&amp;period=<?php echo $_POST['period']; ?>&amp;p=<?php echo isset($tpl['password']) ? $tpl['password'] : null;?></textarea>
				</span>
			</div>
			<?php
		} 
		?>
	</form>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.btn_export = "<?php __('btnExport'); ?>";
	myLabel.btn_get_url = "<?php __('btnGetFeedURL'); ?>";
	</script>
	<?php
}
?>