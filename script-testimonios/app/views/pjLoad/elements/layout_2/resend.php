<div class="pc-container">
	<input type="hidden" id="pc_install_folder" name="install_folder" value="<?php echo PJ_INSTALL_FOLDER; ?>" />
			
	<?php include_once PJ_VIEWS_PATH . 'pjLoad/elements/layout_2/comment_list.php';?>
	
	<div <?php echo !isset($_GET['pjPage']) ? 'id="pc_form_conatiner"' : null; ?> class="pc-form-container">
		<div class="pc-heading">
			<div class="pc-title">
				<div class="left"></div>
				<div class="middle"><span class="title-text"><?php __('front_link_resend_activation_url');?></span></div>
				<div class="right"></div>
			</div>
			<div class="pc-menu">
				<a class="pc-menu-item right-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionLogin<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_login');?></span></a>
				<a class="pc-menu-item left-item" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionRegister<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><span><?php __('front_menu_register');?></span></a>
			</div>
		</div>
		<div class="pc-info-text">
			<?php __('front_resend_text');?>
		</div>
		
		<form name="frmResend" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionResendActivationUrl<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>" method="post" class="pc-form">
			<input type="hidden" name="resend_url" value="1" />
			
			<div class="pc-b5"></div>
			<?php
			if(isset($_GET['err']))
			{
				$resend_messages = __('front_resend_message', true);
				?><div class="<?php echo $_GET['err'] == 'FS01' ? 'pc-message' : 'pc-error';?> pc-b20"><?php echo $resend_messages[$_GET['err']]?></div><?php
			} 
			?>
			
			<div id="pc-message-container" class="pc-message-container"></div>
			
			<p>
				<label class="title"><?php __('front_label_email');?>:</label>
				<input name="email" class="text pc-w50p" />
			</p>
			<p>
				<label class="title">&nbsp;</label>
				<button type="submit" class="submitRequestButton pc-button pc-float-left pc-r10" onclick="PC.Utils.submitResend(event, 'frmResend', 'pc-message-container'); return false;"><abbr></abbr><?php __('front_button_send');?></button>
				<a class="pc-block pc-float-left pc-t15" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjLoad&amp;action=pjActionIndex<?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>"><?php __('front_label_cancel');?></a>
			</p>
		</form>
	</div>
</div>

<script type="text/javascript">
var PC = PC || {};
PC.Msg = {};
<?php
foreach (__('front_error', true) as $k => $v)
{
	
	printf("PC.Msg.%s = '%s';\n", $k, addslashes($v));
	
}
?>
</script>