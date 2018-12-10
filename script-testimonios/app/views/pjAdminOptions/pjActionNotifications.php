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
	include_once PJ_VIEWS_PATH . 'pjLayouts/elements/optmenu.php';
	?>
	<form action="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminOptions&amp;action=pjActionUpdate" method="post" class="pj-form form">
		<input type="hidden" name="options_update" value="1" />
		<input type="hidden" name="next_action" value="pjActionNotifications" />
		
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1"><?php __('tabEmails'); ?></a></li>
				<li><a href="#tabs-2"><?php __('tabSms'); ?></a></li>
			</ul>
			<div id="tabs-1">	
				<?php pjUtil::printNotice(__('infoNotificationsEmailTitle', true), __('infoNotificationsEmailBody', true)); ?>
				
				<fieldset class="fieldset white">
					<legend><?php __('opt_o_email_new_member'); ?></legend>
					<p>
						<label class="title"><?php __('opt_subject'); ?></label>
						<input type="text" name="value-string-o_email_new_member_subject" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes($tpl['o_arr']['o_email_new_member_subject'])); ?>" />
					</p>
					<p>
						<label class="title"><?php __('opt_body_new_member'); ?></label>
						<textarea name="value-text-o_email_new_member" class="pj-form-field w500 h150"><?php echo stripslashes($tpl['o_arr']['o_email_new_member']); ?></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
					</p>
				</fieldset>
				<fieldset class="fieldset white">
					<legend><?php __('opt_o_email_member_confirmation'); ?></legend>
					<p>
						<label class="title"><?php __('opt_subject'); ?></label>
						<input type="text" name="value-string-o_email_member_confirmation_subject" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes($tpl['o_arr']['o_email_member_confirmation_subject'])); ?>" />
					</p>
					<p>
						<label class="title"><?php __('opt_body_member_confirmation'); ?></label>
						<textarea name="value-text-o_email_member_confirmation" class="pj-form-field w500 h150"><?php echo stripslashes($tpl['o_arr']['o_email_member_confirmation']); ?></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
					</p>
				</fieldset>
				<fieldset class="fieldset white">
					<legend><?php __('opt_o_resend_activation_url'); ?></legend>
					<p>
						<label class="title"><?php __('opt_subject'); ?></label>
						<input type="text" name="value-string-o_resend_activation_url_subject" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes($tpl['o_arr']['o_resend_activation_url_subject'])); ?>" />
					</p>
					<p>
						<label class="title"><?php __('opt_body_member_confirmation'); ?></label>
						<textarea name="value-text-o_resend_activation_url" class="pj-form-field w500 h150"><?php echo stripslashes($tpl['o_arr']['o_resend_activation_url']); ?></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
					</p>
				</fieldset>
				<fieldset class="fieldset white">
					<legend><?php __('opt_o_email_new_comment'); ?></legend>
					<p>
						<label class="title"><?php __('opt_subject'); ?></label>
						<input type="text" name="value-string-o_email_new_comment_subject" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes($tpl['o_arr']['o_email_new_comment_subject'])); ?>" />
					</p>
					<p>
						<label class="title"><?php __('opt_body_new_comment'); ?></label>
						<textarea name="value-text-o_email_new_comment" class="pj-form-field w500 h150"><?php echo stripslashes($tpl['o_arr']['o_email_new_comment']); ?></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
					</p>
				</fieldset>
				
				<fieldset class="fieldset white">
					<legend><?php __('opt_o_email_report'); ?></legend>
					<p>
						<label class="title"><?php __('opt_subject'); ?></label>
						<input type="text" name="value-string-o_email_report_subject" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes($tpl['o_arr']['o_email_report_subject'])); ?>" />
					</p>
					<p>
						<label class="title"><?php __('opt_body_report'); ?></label>
						<textarea name="value-text-o_email_report" class="pj-form-field w500 h150"><?php echo stripslashes($tpl['o_arr']['o_email_report']); ?></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
					</p>
				</fieldset>
				
				<fieldset class="fieldset white">
					<legend><?php __('opt_o_email_new_reply'); ?></legend>
					<p>
						<label class="title"><?php __('opt_subject'); ?></label>
						<input type="text" name="value-string-o_email_new_reply_subject" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes($tpl['o_arr']['o_email_new_reply_subject'])); ?>" />
					</p>
					<p>
						<label class="title"><?php __('opt_body_new_reply'); ?></label>
						<textarea name="value-text-o_email_new_reply" class="pj-form-field w500 h150"><?php echo stripslashes($tpl['o_arr']['o_email_new_reply']); ?></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
					</p>
				</fieldset>
				
				<fieldset class="fieldset white">
					<legend><?php __('opt_o_email_password_reminder'); ?></legend>
					<p>
						<label class="title"><?php __('opt_subject'); ?></label>
						<input type="text" name="value-string-o_email_password_reminder_subject" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes($tpl['o_arr']['o_email_password_reminder_subject'])); ?>" />
					</p>
					<p>
						<label class="title"><?php __('opt_body_password_reminder'); ?></label>
						<textarea name="value-text-o_email_password_reminder" class="pj-form-field w500 h150"><?php echo stripslashes($tpl['o_arr']['o_email_password_reminder']); ?></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
					</p>
				</fieldset>
			</div><!-- tab-1 -->
			<div id="tabs-2">
				<?php pjUtil::printNotice(__('infoNotificationsSmsTitle', true), __('infoNotificationsSmsBody', true)); ?>
				<p>
					<label class="title"><?php __('opt_o_sms_new_member_registration'); ?></label>
					<textarea name="value-text-o_sms_new_member_registration" class="pj-form-field w550 h50"><?php echo stripslashes($tpl['o_arr']['o_sms_new_member_registration']); ?></textarea>
				</p>
				<p>
					<label class="title"><?php __('opt_o_sms_new_comment'); ?></label>
					<textarea name="value-text-o_sms_new_comment" class="pj-form-field w550 h50"><?php echo stripslashes($tpl['o_arr']['o_sms_new_comment']); ?></textarea>
				</p>
				<p>
					<label class="title"><?php __('opt_o_sms_comment_reported'); ?></label>
					<textarea name="value-text-o_sms_comment_reported" class="pj-form-field w550 h50"><?php echo stripslashes($tpl['o_arr']['o_sms_comment_reported']); ?></textarea>
				</p>
				<p>
					<label class="title">&nbsp;</label>
					<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				</p>
			</div>
		</div>
	</form>
	<?php
}
?>