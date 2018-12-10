<?php
if(!empty($tpl['comment_arr']))
{
	foreach($tpl['comment_arr'] as $k => $v)
	{
		$rating = intval($v['rating']);
		?>
		<div id="pjCpComment_<?php echo $controller->getTopic();?>" class="comment-box pjCpComment">
			<div class="container-fluid">
				<div class="row pjCpCommentHead">
					<?php
					if(!empty($v['avatar_path']))
					{
						if(file_exists(PJ_INSTALL_PATH . $v['avatar_path']))
						{
							?>
							<div class="pull-left pjCpAvatar">
								<img class="img-thumbnail" alt="Thumbnail Image" src="<?php echo PJ_INSTALL_FOLDER . $v['avatar_path'];?>" />
							</div>
							<?php
						}
					}  
					?>
					<div class="pull-left">
						<p class="pjCpCommentTitle"><strong><?php echo stripslashes($v['member']); ?></strong></p>

						<span class="pjCpCommentDate"><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['created'])), "Y-m-d", $tpl['option_arr']['o_date_format']) . ', ' . date($tpl['option_arr']['o_time_format'], strtotime($v['created'])); ?></span>
						<?php
						if($tpl['option_arr']['o_allow_topic_rating'] == 'Yes')
						{ 
							?>
							<p class="pjCpCommentStars">
								<?php
								for($i = 1; $i <= 5; $i++)
								{
									if($i <= $rating)
									{
										?><span class="glyphicon glyphicon-star" aria-hidden="true"></span><?php
									}else{
										?><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span><?php
									}
								} 
								?>
							</p>
							<?php
						} 
						?>
					</div><!-- /.pull-left -->
					
					<p class="pull-right pjCpCommentActions">
						<?php
						if($tpl['option_arr']['o_allow_comment_rating'] == 'Yes')
						{ 
							?>
							<span id="pc_vote_up_<?php echo $v['id']?>" class="text-success">+<?php echo intval($v['likes']) ?></span>

							<a href="javascript:void(0);" class="btn btn-default btn-sm pc-vote like" rev="<?php echo $v['id'];?>" rel="up">
								<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
							</a>
							
							<a href="javascript:void(0);" class="btn btn-default btn-sm pc-vote dislike" rev="<?php echo $v['id'];?>" rel="down">
								<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
							</a>

							<span id="pc_vote_down_<?php echo $v['id']?>" class="text-danger">-<?php echo intval($v['dislikes']) ?></span>
							<?php
						}
						if($tpl['option_arr']['o_allow_comment_reporting'] == 'Yes')
						{ 
							?>
							&nbsp;

							<a href="javascript:void(0);" class="btn btn-default btn-sm pc-report" rev="<?php echo $v['id'];?>"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
							<?php
						} 
						?>
					</p><!-- /.pull-right pjCpCommentActions -->
				</div><!-- /.row pjCpComment -->
				
				<div class="row pjCpCommentBody">
					<p><?php echo nl2br(pjSanitize::clean($v['comment_text']));?></p>
				</div><!-- /.row pjCpCommentBody -->
				<?php
				if(isset($tpl['comment_file_arr']))
				{ 
					$comment_file_arr = $tpl['comment_file_arr'];
					if(!empty($comment_file_arr[$v['id']]))
					{
						$file_arr = $comment_file_arr[$v['id']];
						?>
						<div class="row pjCpCommentBody">
							<div class="col-md-1">
								<div class="row">
									<p><?php __('front_files'); ?>:</p>
								</div>
							</div>
							<div class="col-md-11">
								<div class="row">
									<?php
									foreach($file_arr as $k => $f)
									{
										?><a target="_blank" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&action=pjActionDownloadFile&id=<?php echo $f['id']; ?>&hash=<?php echo $f['hash']; ?>"><?php echo $f['file_name'];?></a><?php echo $k < count($file_arr) -1 ? '<br/>' : null; 
									} 
									?>
								</div>
							</div>
						</div><!-- /.row pjCpCommentBody -->
						<?php
					}
				} 
				?>
			</div><!-- /.container-fluid -->
		</div><!-- /.comment-box pjCpComment -->
		
		<hr>
		<?php
	}
	include_once PJ_VIEWS_PATH . 'pjLoad/elements/pagination.php';
} else {
	__('front_not_found');
}
?>
