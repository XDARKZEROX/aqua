<div class="pc-comment-list">
	<?php
	if(!empty($tpl['comment_arr']))
	{
		foreach($tpl['comment_arr'] as $k => $v)
		{
			$rating = intval($v['rating']);
			?>
			<div class="pc-comment-box">
				<div class="heading">
					<?php
					if(!empty($v['avatar_path']))
					{
						if(file_exists(PJ_INSTALL_PATH . $v['avatar_path']))
						{
							?><img class="avatar" src="<?php echo PJ_INSTALL_URL . $v['avatar_path'];?>" /><?php
						}
					} 
					?>
					<div class="comment-detail">
						<label><?php echo stripslashes($v['member']); ?></label>
						<span><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['created'])), "Y-m-d", $tpl['option_arr']['o_date_format']) . ' ' . date($tpl['option_arr']['o_time_format'], strtotime($v['created'])); ?></span>
						<?php
						if($tpl['option_arr']['o_allow_topic_rating'] == 'Yes')
						{ 
							?>
							<div class="rating">
								<div class="star-outer">
									<?php
									for($i = 1; $i <= 5; $i++)
									{
										if($i <= $rating)
										{
											?><span class="yellow-star"></span><?php
										}else{
											?><span class="grey-star"></span><?php
										}	
									}	 
									?>
								</div>
							</div>
							<?php
						} 
						?>
					</div><!-- comment-detail -->
					<div class="vote-container">
						<?php
						if($tpl['option_arr']['o_allow_comment_reporting'] == 'Yes')
						{ 
							?>
							<a href="javascript:void(0);" class="pc-report" rev="<?php echo $v['id'];?>"></a>
							<?php 
						}
						if($tpl['option_arr']['o_allow_comment_rating'] == 'Yes')
						{ 
							?>
							<label id="pc_vote_down_<?php echo $v['id']?>" class="dislike-count">-<?php echo intval($v['dislikes']) ?></label>
							<a href="javascript:void(0);" class="pc-vote dislike" rev="<?php echo $v['id'];?>" rel="down"></a>
							<a href="javascript:void(0);" class="pc-vote like" rev="<?php echo $v['id'];?>" rel="up"></a>
							<label id="pc_vote_up_<?php echo $v['id']?>"  class="like-count">+<?php echo intval($v['likes']) ?></label>
							<?php
						} 
						?>
					</div><!-- vote-container -->
				</div><!-- heading -->
				
				<div class="comment-text">
					<?php echo nl2br(pjSanitize::clean($v['comment_text']));?>
				</div><!-- comment-text -->
				<?php
				if(isset($tpl['comment_file_arr']))
				{
					$comment_file_arr = $tpl['comment_file_arr'];
					if(!empty($comment_file_arr[$v['id']]))
					{
						$file_arr = $comment_file_arr[$v['id']];
						?>
						<div class="file-list">
							<label><?php __('front_files'); ?>:</label>
							<ul class="files">
								<?php
								foreach($file_arr as $f)
								{
									?><li><a target="_blank" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&action=pjActionDownloadFile&id=<?php echo $f['id']; ?>&hash=<?php echo $f['hash']; ?>"><?php echo $f['file_name'];?></a></li><?php
								} 
								?>
							</ul>
						</div>
						<?php
					}
				} 
				?>
			</div><!-- pc-comment-box -->
			<?php
		}
		
		include_once PJ_VIEWS_PATH . 'pjLoad/elements/layout_3/pagination.php';
	} else {
		?><div class="pc-not-found"><?php __('front_not_found'); ?></div><?php
	}
	?>
</div>