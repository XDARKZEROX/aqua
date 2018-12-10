<div class="pc-container">
	<input type="hidden" id="pc_install_folder" name="install_folder" value="<?php echo PJ_INSTALL_FOLDER; ?>" />
			
	<?php include_once PJ_VIEWS_PATH . 'pjLoad/elements/layout_3/comment_list.php';?>
	
	<div <?php echo !isset($_GET['pjPage']) ? 'id="pc_form_conatiner"' : null; ?> class="pc-form-container">
		<div class="pc-heading">
			<div class="pc-title">
				<div class="left"></div>
				<div class="middle"><span class="title-text"><?php __('front_menu_register');?></span></div>
				<div class="right"></div>
			</div>
			<div class="pc-menu">
				<a class="pc-menu-item right-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogin<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_login');?></span></a>
			</div>
		</div>
		<div class="pc-info-text">
			<?php __('front_register_text');?>
		</div>
		
		<form name="frmRegister" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionRegister<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>" method="post" class="pc-form" enctype="multipart/form-data">
			<input type="hidden" name="register" value="1" />
			
			<div class="pc-b5"></div>
			<?php
			if(isset($_GET['err']))
			{
				$register_messages = __('front_register_message', true);
				?><div class="<?php echo ($_GET['err'] == 'FR01' || $_GET['err'] == 'FR011' || $_GET['err'] == 'FR012'  || $_GET['err'] == 'FR013') ? 'pc-message' : 'pc-error';?> pc-b20"><?php echo $register_messages[$_GET['err']]?></div><?php
			} 
			?>
			
			<div id="pc-message-container" class="pc-message-container"></div>
			
			<p>
				<label class="title"><?php __('front_label_name');?>:</label>
				<input name="name" class="text pc-w50p" />
			</p>
			<p>
				<label class="title"><?php __('front_label_email');?>:</label>
				<input name="email" class="text pc-w50p" />
			</p>
			<p>
				<label class="title"><?php __('front_label_password');?>:</label>
				<input type="password" name="password" class="text pc-w50p" />
			</p>
			<p>
				<label class="title"><?php __('front_label_website');?>:</label>
				<input name="website" class="text pc-w60p" />
			</p>
			<p>
				<label class="title"><?php __('front_label_verification');?>:</label>
				<img class="pc-captcha" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;rand=<?php echo rand(1, 999999); ?>" alt="CAPTCHA" style="vertical-align: middle" />
				<input type="text" name="verification" id="verification" class="text pc-w110" maxlength="6" autocomplete="off" />
			</p>
			<p>
				<label class="title">&nbsp;</label>
				<button type="submit" class="submitRequestButton pc-button pc-float-left pc-r10" onclick="PC.Utils.submitRegister(event, 'frmRegister', 'pc-message-container'); return false;"><abbr></abbr><?php __('front_button_register');?></button>
				<a class="pc-block pc-float-left pc-t5" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionResendActivationUrl<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><?php __('front_link_resend_activation_url');?></a>
				<br/>
				<a class="pc-block pc-t10" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionIndex<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><?php __('front_label_cancel');?></a>
			</p>
		</form>
	</div>
</div>