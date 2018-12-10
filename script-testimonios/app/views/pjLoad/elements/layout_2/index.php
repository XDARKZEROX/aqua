<div class="pc-container">
	<input type="hidden" id="pc_install_folder" name="install_folder" value="<?php echo PJ_INSTALL_FOLDER; ?>" />
			
	<?php include_once PJ_VIEWS_PATH . 'pjLoad/elements/layout_2/comment_list.php';?>
	<div class="pc-form-container">
		<div class="pc-heading">
			<div class="pc-title">
				<div class="left"></div>
				<div class="middle"><span class="title-text"><?php __('front_label_leave_comment');?></span></div>
				<div class="right"></div>
			</div>
			<div class="pc-menu">

				<?php
				if($controller->checkLogin())
				{ 
					?>
					<a class="pc-menu-item right-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogout<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_logout');?></span></a>
					<a class="pc-menu-item left-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionMyProfile<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_my_profile');?></span></a>
					<?php
				}else{
					?>
					<a class="pc-menu-item right-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogin<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_login');?></span></a>
					<a class="pc-menu-item left-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionRegister<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_register');?></span></a>
					<?php
				} 
				?>
				
			</div>
		</div>
		<form name="frmPostComment" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionIndex<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>" method="post" class="pc-form"  enctype="multipart/form-data">
		
			<input type="hidden" name="post_comment" value="1" />
			<input type="hidden" name="topic_id" value="<?php echo $tpl['topic_id']?>" />
			
			<div class="pc-b20"></div>
			<?php
			if(isset($_GET['err']))
			{
				$post_messages = __('front_postcomment', true);
				?><div class="<?php echo in_array($_GET['err'], array('FPC01', 'FPC04', 'FPC05')) ? 'pc-message' : 'pc-error';?> pc-b20"><?php echo $post_messages[$_GET['err']]?></div><?php
			} 
			?>
			<div id="pc-message-container" class="pc-message-container"></div>
			<?php
			if($tpl['option_arr']['o_allow_topic_rating'] == 'Yes')
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_rate');?>:</label>
					<input type="hidden" id="rating_value" name="rating" value="" />
					<span class="rating">
						<span id="star_1" class="pc-star" lang="1"></span>
						<span id="star_2" class="pc-star" lang="2"></span>
						<span id="star_3" class="pc-star" lang="3"></span>
						<span id="star_4" class="pc-star" lang="4"></span>
						<span id="star_5" class="pc-star" lang="5"></span>
					</span>
				</p>
				<?php
			} 
			if(!$controller->checkLogin())
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_name');?>:</label>
					<input name="name" class="text pc-w50p" />
				</p>
				<p>
					<label class="title"><?php __('front_label_email');?>:</label>
					<input name="email" class="text pc-w50p" />
				</p>
				<?php
			} 
			?>
			<p>
				<label class="title"><?php __('front_label_comment');?>:</label>
				<textarea name="comment_text" class="textarea pc-w70p pc-h150"></textarea>
			</p>
			<?php
			if($tpl['option_arr']['o_allow_topic_subscribing'] == 'Yes')
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_subscribe');?>:</label>
					<input name="subscribed" type="checkbox" value="1" class="checkbox pc-t5"/>
				</p>
				<?php
			} 
			?>
			<?php
			if($tpl['option_arr']['o_allow_file_uploading'] == 'Yes')
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_upload_file');?>:</label>
					<input type="file" name="file"/>
				</p>
				<?php
			} 
			if(!$controller->checkLogin())
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_verification');?>:</label>
					<img class="pc-captcha" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;rand=<?php echo rand(1, 999999); ?>" alt="CAPTCHA" style="vertical-align: middle" />
					<input type="text" name="verification" id="verification" class="text pc-w110" maxlength="6" autocomplete="off" />
				</p>
				<?php
			} 
			?>
			<p>
				<label class="title">&nbsp;</label>
				<button type="submit" class="submitRequestButton pc-button" onclick="PC.Utils.postComment(event, 'frmPostComment', 'pc-message-container', this); return false;"><abbr></abbr><?php __('front_button_add_comment');?></button>
			</p>
		</form>
	</div>
</div>