<div class="pc-container">
	<input type="hidden" id="pc_install_folder" name="install_folder" value="<?php echo PJ_INSTALL_FOLDER; ?>" />
			
	<?php include_once PJ_VIEWS_PATH . 'pjLoad/elements/layout_2/comment_list.php';?>
	
	<div <?php echo !isset($_GET['pjPage']) ? 'id="pc_form_conatiner"' : null; ?> class="pc-form-container">
		<div class="pc-heading">
			<div class="pc-title">
				<div class="left"></div>
				<div class="middle"><span class="title-text"><?php __('front_menu_my_profile');?></span></div>
				<div class="right"></div>
			</div>
			<div class="pc-menu">
				<a class="pc-menu-item right-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogout<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_logout');?></span></a>
			</div>
		</div>
		<div class="pc-info-text">
			<?php __('front_my_profile_text');?>
		</div>
		
		<form name="frmMyProfile" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionMyProfile<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>" method="post" class="pc-form" enctype="multipart/form-data">
			<input type="hidden" name="update_profile" value="1" />
			<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
			
			<div class="pc-b5"></div>
			<?php
			if(isset($_GET['err']))
			{
				$profile_messages = __('front_profile_message', true);
				?><div class="<?php echo $_GET['err'] == 'FP01' ? 'pc-message' : 'pc-error';?> pc-b20"><?php echo $profile_messages[$_GET['err']]?></div><?php
			} 
			?>
			
			<div id="pc-message-container" class="pc-message-container"></div>
			
			<p>
				<label class="title"><?php __('front_label_name');?>:</label>
				<input name="name" class="text pc-w50p" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['name'])); ?>" />
			</p>
			<p>
				<label class="title"><?php __('front_label_email');?>:</label>
				<input name="email" class="text pc-w50p" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['email'])); ?>"/>
			</p>
			<p>
				<label class="title"><?php __('front_label_password');?>:</label>
				<input type="password" name="password" class="text pc-w50p" value="password" />
			</p>
			<p>
				<label class="title"><?php __('front_label_website');?>:</label>
				<input name="website" class="text pc-w60p" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['website'])); ?>"/>
			</p>
			<p>
				<label class="title"><?php __('front_label_avatar');?>:</label>
				<input type="file" name="avatar"/>
			</p>
			<?php
			if(!empty($tpl['arr']['avatar_path']))
			{
				$avatar_path =  $tpl['arr']['avatar_path'];
				if (file_exists(PJ_INSTALL_PATH . $avatar_path)) 
				{
					$avatar_url = PJ_INSTALL_URL . $avatar_path;
					?>
					<p id="pc_avatar_container">
						<label class="title">&nbsp;</label>
						<img class="pc-avatar" src="<?php echo $avatar_url;?>" />
						<a class="pc-remove-icon" href="javascript:void(0);" onclick="PC.Utils.removeAvatar(event, '<?php echo $tpl['arr']['id'];?>', 'pc_avatar_container'); return false;"><?php __('front_label_remove');?></a>
					</p>
					<?php
				}
			} 
			?>
			<p>
				<label class="title">&nbsp;</label>
				<button type="submit" class="submitRequestButton pc-button pc-float-left pc-r10" onclick="PC.Utils.updateProfile(event, 'frmMyProfile', 'pc-message-container'); return false;"><abbr></abbr><?php __('front_button_update');?></button>
				<a class="pc-block pc-float-left pc-t15" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionIndex<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><?php __('front_label_cancel');?></a>
			</p>
		</form>
	</div>
</div>