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
}else{
	$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	?>
	<div class="dashboard">
		<div class="dashboard_header">
			<div class="left"></div>
			<div class="middle">
				<div class="topics"><div class="header-content"><span><?php echo $tpl['num_of_topics']?></span><label><?php echo $tpl['num_of_topics'] > 1 ? strtolower(__('lblTopics', true)) : strtolower(__('lblTopic', true)); ?></label></div></div>
				<div class="comments"><div class="header-content"><span><?php echo $tpl['num_of_comments']?></span><label><?php echo $tpl['num_of_comments'] > 1 ? strtolower(__('lblComments', true)) : strtolower(__('lblComment', true)); ?></label></div></div>
				<div class="members"><div class="header-content"><span><?php echo $tpl['num_of_members']?></span><label><?php echo $tpl['num_of_members'] > 1 ? strtolower(__('lblMembers', true)) : strtolower(__('lblMember', true)); ?></label></div></div>
			</div>
			<div class="right"></div>
		</div>
		<div class="dashboard_box topic_box">
			<div class="header">
				<div class="left"></div>
				<div class="middle"><span><?php __('lblPopularTopics'); ?></span></div>
				<div class="right"></div>
			</div>
			<div class="content">
				<div class="dashboard_list">
					<?php
					if(!empty($tpl['popular_topics']))
					{
						$row_count = count($tpl['popular_topics']);
						foreach($tpl['popular_topics'] as $k => $v)
						{
							?>
							<div class="dashboard_row topic_row <?php echo $k + 1 == $row_count ? 'dashboard_last_row' : null; ?>">
								<div class="topic_title">
									<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminTopics&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo pjSanitize::html(stripslashes($v['topic']));?></a>
									<?php
									
									if(!empty($v['last_time']))
									{ 
										?><span class="datetime"><?php __('lblLast');?>:&nbsp;<?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['last_time'])), "Y-m-d", $tpl['option_arr']['o_date_format']) . ' ' . date($tpl['option_arr']['o_time_format'], strtotime($v['last_time'])); ?></span><?php
									}else{
										?><span class="datetime"><?php __('lblNoComments');?></span><?php
									}
									?>
								</div>
								<?php
								if($v['cnt_comments'] > 0)
								{ 
									?>
									<div class="topic_comments">
										<abbr><?php echo $v['cnt_comments'];?></abbr><label><?php echo $v['cnt_comments'] > 1 ? strtolower(__('lblComments', true)) : strtolower(__('lblComment', true)); ?></label>
									</div>
									<?php
								} 
								?>
							</div>
							<?php
						}
					} else {
						?>
						<div class="dashboard_row"><div class="topic_title"><?php __('lblNoTopicFound');?></div></div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="footer">
				<div class="left"></div>
				<div class="middle"></div>
				<div class="right"></div>
			</div>
		</div>
		<div class="dashboard_box comment_box">
			<div class="header">
				<div class="left"></div>
				<div class="middle"><span><?php __('lblLatestComments'); ?></span></div>
				<div class="right"></div>
			</div>
			<div class="content">
				<div class="dashboard_list">
					<?php
					if(!empty($tpl['latest_comments']))
					{
						$row_count = count($tpl['latest_comments']);
						foreach($tpl['latest_comments'] as $k => $v)
						{
							?>
							<div class="dashboard_row comment_row <?php echo $k + 1 == $row_count ? 'dashboard_last_row' : null; ?>">
								<label><?php __('lblBy');?>&nbsp;<?php echo $v['member']?></label>
								<span class="datetime"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminComments&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['created'])), "Y-m-d", $tpl['option_arr']['o_date_format']) . ' ' . date($tpl['option_arr']['o_time_format'], strtotime($v['created'])); ?></a></span>
								<span><?php echo $v['topic']?></span>
							</div>
							<?php
						}
					} else {
						?>
						<div class="dashboard_row"><div class="topic_title"><?php __('lblNoCommentFound');?></div></div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="footer">
				<div class="left"></div>
				<div class="middle"></div>
				<div class="right"></div>
			</div>
		</div>
		<div class="dashboard_box member_box">
			<div class="header">
				<div class="left"></div>
				<div class="middle"><span><?php __('lblTopMembers');?></span></div>
				<div class="right"></div>
			</div>
			<div class="content">
				<div class="dashboard_list">
					<?php
					if(!empty($tpl['top_members']))
					{
						$row_count = count($tpl['top_members']);
						foreach($tpl['top_members'] as $k => $v)
						{
							?>
							<div class="dashboard_row member_row <?php echo $k + 1 == $row_count ? 'dashboard_last_row' : null; ?>">
								<label><?php echo $v['name']?></label>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo $v['email'];?></a>
								<span class="datetime"><?php __('lblLastComment'); ?>:&nbsp;<?php echo !empty($v['last_time']) ? pjUtil::formatDate(date('Y-m-d', strtotime($v['last_time'])), "Y-m-d", $tpl['option_arr']['o_date_format']) . ' ' . date($tpl['option_arr']['o_time_format'], strtotime($v['last_time'])) : null; ?></span>
								<abbr><?php echo $v['cnt_comments'];?>&nbsp;<?php echo $v['cnt_comments'] > 1 ? strtolower(__('lblComments', true)) : strtolower(__('lblComment', true)); ?></abbr>
							</div>
							<?php
						}
					} else {
						?>
						<div class="dashboard_row"><div class="topic_title"><?php __('lblNoMemberFound');?></div></div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="footer">
				<div class="left"></div>
				<div class="middle"></div>
				<div class="right"></div>
			</div>
		</div>
	</div>
	<div class="clear_left t20 overflow">
		<div class="float_left black t30"><span class="gray"><?php echo ucfirst(__('lblDashLastLogin', true)); ?>:</span> <?php echo date("F d, Y H:i", strtotime($_SESSION[$controller->defaultUser]['last_login'])); ?></div>
		<div class="float_right overflow">
		<?php
		list($hour, $day, $other) = explode("_", date("H:i_l_F d, Y"));
		?>
			<div class="dashboard_date">
				<abbr><?php echo $day; ?></abbr>
				<?php echo $other; ?>
			</div>
			<div class="dashboard_hour"><?php echo $hour; ?></div>
		</div>
	</div>
	<?php
}
?>