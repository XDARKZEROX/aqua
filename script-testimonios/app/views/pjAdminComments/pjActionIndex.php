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
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionIndex"><?php __('menuComments'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionFeed"><?php __('lblExportFeed'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoCommentsTitle', true), __('infoCommentsDesc', true));
	?>
	<div class="b10">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="float_left pj-form r10">
			<input type="hidden" name="controller" value="pjAdminComments" />
			<input type="hidden" name="action" value="pjActionCreate" />
			<input type="submit" class="pj-button" value="<?php __('btnAddComment'); ?>" />
		</form>
		<form action="" method="get" class="float_left pj-form frm-filter">
			<input type="text" name="q" class="pj-form-field pj-form-field-search w150" placeholder="<?php __('btnSearch'); ?>" />
		</form>
		<?php
		$statuses = __('comment_statarr', true);
		?>
		<div class="float_right t5">
			<a href="#" class="pj-button btn-all">All</a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="T"><?php echo $statuses['T']; ?></a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="R"><?php echo $statuses['R']; ?></a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="F"><?php echo $statuses['F']; ?></a>
		</div>
		<br class="clear_both" />
	</div>

	<div id="grid" class="pjPcCommentGrid"></div>
	<script type="text/javascript">
	var pjGrid = pjGrid || {};
	pjGrid.jsDateFormat = "<?php echo pjUtil::jsDateFormat($tpl['option_arr']['o_date_format']); ?>";
	<?php
	if(isset($_GET['member_id']))
	{ 
		?>
		pjGrid.member_id = "<?php echo $_GET['member_id']; ?>";
		<?php
	} 
	?>
	<?php
	if(isset($_GET['topic_id']))
	{ 
		?>
		pjGrid.topic_id = "<?php echo $_GET['topic_id']; ?>";
		<?php
	} 
	?>
	var myLabel = myLabel || {};
	myLabel.topic = "<?php __('lblTopic'); ?>";
	myLabel.member = "<?php __('lblMember'); ?>";
	myLabel.comment = "<?php __('lblComment'); ?>";
	myLabel.revert_status = "<?php __('lblRevertStatus'); ?>";
	myLabel.inactive = "<?php __('lblInactive'); ?>";
	myLabel.exported = "<?php __('lblExport'); ?>";
	myLabel.approved = "<?php echo $statuses['T']; ?>";
	myLabel.reported = "<?php echo $statuses['R']; ?>";
	myLabel.notapproved = "<?php echo $statuses['F']; ?>";
	myLabel.delete_selected = "<?php __('pc_delete_selected'); ?>";
	myLabel.delete_confirmation = "<?php __('pc_delete_confirmation'); ?>";
	myLabel.status = "<?php __('lblStatus'); ?>";
	</script>
	<?php
}
?>