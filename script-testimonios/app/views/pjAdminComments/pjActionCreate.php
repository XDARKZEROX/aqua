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
	$is_exiting = __('existing_arr', true);

	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionIndex"><?php __('menuComments'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionFeed"><?php __('lblExportFeed'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoAddCommentTitle', true), __('infoAddCommentDesc', true));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionCreate" method="post" id="frmCreateComment" class="form pj-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="comment_create" value="1" />
		
		<div class="clear_both">
			<p>
				<label class="title"><?php __('lblMember'); ?></label>
				<span class="inline_block">
					<select name="is_existing" id="is_existing" class="pj-form-field w250 required">
						<option value="T"><?php echo $is_exiting['T']; ?></option>
						<option value="F"><?php echo $is_exiting['F']; ?></option>
					</select>
				</span>
			</p>
			<div id="new_container" style="display:none;">
				<p>
					<label class="title"><?php __('lblName'); ?></label>
					<span class="inline_block">
						<input type="text" name="name" id="name" class="pj-form-field w250" />
					</span>
				</p>
				<p>
					<label class="title"><?php __('lblEmail'); ?></label>
					<span class="pj-form-field-custom pj-form-field-custom-before">
						<span class="pj-form-field-before"><abbr class="pj-form-field-icon-email"></abbr></span>
						<input type="text" name="email" id="email" class="pj-form-field email w200" />
					</span>
				</p>
			</div>
			<div id="existing_container" style="display:block;">
				<p>
					<label class="title">&nbsp;</label>
					<span class="inline_block">
						<select name="member_id" id="member_id" class="pj-form-field required w250">
							<option value="">-- <?php __('lblChoose'); ?>--</option>
							<?php
							foreach ($tpl['member_arr'] as $k => $v)
							{
								?><option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option><?php
							}
							?>
						</select>
						<a id="pjPcEditMember" href="#" data-href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionUpdate&amp;id={ID}" class="pjPcEdit"></a>
					</span>
				</p>
			</div>
			<p>
				<label class="title"><?php __('lblTopic'); ?></label>
				<span class="inline_block">
					<select name="topic_id" id="topic_id" class="pj-form-field required w250">
						<option value="">-- <?php __('lblChoose'); ?>--</option>
						<?php
						foreach ($tpl['topic_arr'] as $k => $v)
						{
							?><option value="<?php echo $v['id']; ?>" data-url="<?php echo $v['page_url'];?>"><?php echo $v['topic']; ?></option><?php
						}
						?>
					</select>
					<a id="pjPcEditTopic" href="#" data-href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminTopics&amp;action=pjActionUpdate&amp;id={ID}" class="pjPcEdit"></a>
					<a id="pjPcPreviewTopic" href="#" class="pjPcPreview pjPcTopPreview" target="_blank"></a>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblPageComment'); ?></label>
				<span class="inline_block">
					<textarea name="comment_text" class="pj-form-field w568 h180 required"></textarea>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblSubscribedToDiscussion'); ?></label>
				<span class="inline_block">
					<input name="subscribed" type="checkbox" value="1" class="pj-form-field checkbox"/>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblCommentFiles'); ?></label>
				<span class="inline_block">
					<input name="files[]" type="file" multiple="multiple"/>
				</span>
			</p>
			<?php
			if($tpl['option_arr']['o_allow_topic_rating'] == 'Yes')
			{ 
				?>
				<p>
					<label class="title"><?php __('lblRating'); ?></label>
					<input type="hidden" id="rating_value" name="rating" value="0" />
					<span class="rating">
						<span id="star_1" class="star" lang="1"></span>
						<span id="star_2" class="star" lang="2"></span>
						<span id="star_3" class="star" lang="3"></span>
						<span id="star_4" class="star" lang="4"></span>
						<span id="star_5" class="star" lang="5"></span>
					</span>
					
				</p>
				<?php
			}else{
				?>
				<input type="hidden" id="rating_value" name="rating" value="0" />
				<?php
			} 
			?>
			<p>
				<label class="title"><?php __('lblStatus'); ?></label>
				<span class="inline_block">
					<select name="status" id="status" class="pj-form-field required">
						<option value="">-- <?php __('lblChoose'); ?>--</option>
						<?php
						foreach (__('comment_statarr', true) as $k => $v)
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
				<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminComments&action=pjActionIndex';" />
			</p>
		</div>
	</form>
	
	<?php
}
?>