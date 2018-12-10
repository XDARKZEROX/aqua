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
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionFeed"><?php __('lblExportFeed'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoUpdateCommentTitle', true), __('infoUpdateCommentDesc', true));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionUpdate" method="post" id="frmUpdateComment" class="form pj-form" enctype="multipart/form-data">
		<input type="hidden" name="comment_update" value="1" />
		<input type="hidden" id="comment_id" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<div class="w350 float_left">
			<p>
				<label class="title"><?php __('lblDateTime'); ?></label>
				<span class="inline_block">
					<label class="content"><?php echo date($tpl['option_arr']['o_date_format'], strtotime($tpl['arr']['created']));?>, <?php echo date($tpl['option_arr']['o_time_format'], strtotime($tpl['arr']['created']));?></label>
				</span>
			</p>
		</div>
		<div class="w350 float_right">
			<?php
			if($tpl['option_arr']['o_allow_topic_rating'] == 'Yes')
			{
				?>
				<div class="pjCpCommentVote">
					<span class="pjCpLike">+ <?php echo $tpl['arr']['likes'];?></span>
					<div class="pjCpHand"></div>
					<span class="pjCpDislike">- <?php echo $tpl['arr']['dislikes'];?></span>
				</div>
				<?php
			}
			?>
		</div>
		<div style="clear:both;"></div>
		<p>
			<label class="title"><?php __('lblIp'); ?></label>
			<span class="inline_block">
				<label class="content"><?php echo $tpl['arr']['ip'];?></label>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblMember'); ?></label>
			<span class="inline_block">
				<select name="member_id" id="member_id" class="pj-form-field required w200">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach ($tpl['member_arr'] as $k => $v)
					{
						$name = $v['name'] . ($v['status'] == 'F' ? ' ('.__('pc_inactive', true).')' : NULL);
						if($tpl['arr']['member_id'] == $v['id'])
						{
							?><option value="<?php echo $v['id']; ?>" selected="selected"><?php echo $name; ?></option><?php
						}else{
							?><option value="<?php echo $v['id']; ?>"><?php echo $name; ?></option><?php
						}
					}
					?>
				</select>
				<a id="pjPcEditMember" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionUpdate&amp;id=<?php echo $tpl['arr']['member_id'];?>" data-href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionUpdate&amp;id={ID}" class="pjPcEdit"></a>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblTopic'); ?></label>
			<span class="inline_block">
				<select name="topic_id" id="topic_id" class="pj-form-field required w300">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach ($tpl['topic_arr'] as $k => $v)
					{
						if($tpl['arr']['topic_id'] == $v['id'])
						{
							?><option value="<?php echo $v['id']; ?>" selected="selected" data-url="<?php echo $v['page_url'];?>"><?php echo $v['topic']; ?></option><?php
						}else{
							?><option value="<?php echo $v['id']; ?>" data-url="<?php echo $v['page_url'];?>"><?php echo $v['topic']; ?></option><?php
						}
					}
					?>
				</select>
				<a id="pjPcEditTopic" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminTopics&amp;action=pjActionUpdate&amp;id=<?php echo $tpl['arr']['topic_id'];?>" data-href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminTopics&amp;action=pjActionUpdate&amp;id={ID}" class="pjPcEdit"></a>
				<a id="pjPcPreviewTopic" href="<?php echo $tpl['arr']['page_url'];?>" class="pjPcPreview pjPcTopPreview" target="_blank"></a>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblPageComment'); ?></label>
			<span class="inline_block">
				<textarea name="comment_text" class="pj-form-field w568 h180 required"><?php echo stripslashes($tpl['arr']['comment_text']);?></textarea>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblSubscribedToDiscussion'); ?></label>
			<span class="inline_block">
				<input name="subscribed" type="checkbox" value="1" <?php echo !empty($tpl['arr']['subscribed']) ? 'checked="checked"' : null; ?> class="pj-form-field checkbox"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblCommentFiles'); ?></label>
			<span class="inline_block">
				<input name="files[]" type="file" multiple="multiple"/>
			</span>
		</p>
		
		<?php
		if(!empty($tpl['comment_file_arr']))
		{
			?>
			<ul class="files">
				<?php
				foreach($tpl['comment_file_arr'] as $f)
				{
					?>
					<li id="file_container_<?php echo $f['id'];?>"><a class="file-name" target="_blank" href="<?php echo PJ_INSTALL_URL;?>index.php?controller=pjAdminComments&action=pjActionDownloadFile&id=<?php echo $f['id']; ?>"><?php echo $f['file_name'];?></a><a class="icon-remove-file" rev="<?php echo $f['id']; ?>" href="javascript:void(0);"></a></li>
					<?php 
				}	 
				?>
			</ul>
			<?php 
		}
		if($tpl['option_arr']['o_allow_topic_rating'] == 'Yes')
		{	 
			?>
			<p>
				<label class="title"><?php __('lblRating'); ?></label>
				<input type="hidden" id="rating_value" name="rating" value="<?php echo intval($tpl['arr']['rating']);?>" />
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
			?><input type="hidden" id="rating_value" name="rating" value="<?php echo intval($tpl['arr']['rating']);?>" /><?php
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
						if($tpl['arr']['status'] == $k)
						{
							?><option value="<?php echo $k; ?>" selected="selected"><?php echo $v; ?></option><?php
						}else{
							?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
						}
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
			<input type="button" value="<?php __('btnDelete'); ?>" class="pj-button pj-delete-comment" />
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminComments&action=pjActionIndex';" />
		</p>
	</form>
	
	<div id="dialogDeleteFile" title="<?php __('lblDeleteFileTitle'); ?>" style="display:none;">
		<div class="t15">
			<?php __('lblDeleteFileConfirmation'); ?>
			<input type="hidden" id="record_id" name="record_id" value="" />
		</div>
	</div>
	<div id="dialogDeleteComment" title="<?php __('lblDeleteCommentTitle'); ?>" style="display:none;">
		<div class="t15">
			<?php __('lblDeleteCommentConfirmation'); ?>
		</div>
	</div>
	<?php
}
?>