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
	
	<div class="form pj-form">
			
		<?php pjUtil::printNotice(__('infoInstallTitle', true), __('infoInstallDesc', true));; ?>
		<p>
			<label class="title"><?php __('lblSelectPage');?></label>
			<span class="inline_block">
				<?php
				if(count($tpl['topic_arr']) > 0)
				{ 
					?>
					<select name="topic_id" id="topic_id" class="pj-form-field w150 required" data-msg-required="<?php __('lblFieldRequired');?>">
						<option value="">-- <?php __('lblChoose'); ?>--</option>
						<?php
						foreach ($tpl['topic_arr'] as $k => $v)
						{
							if(isset($_GET['id']))
							{
								if($_GET['id'] == $v['id']){
									?><option value="<?php echo $v['id']; ?>" selected="selected"><?php echo $v['topic']; ?></option><?php
								}else{
									?><option value="<?php echo $v['id']; ?>"><?php echo $v['topic']; ?></option><?php
								}
							}else{
								?><option value="<?php echo $v['id']; ?>"><?php echo $v['topic']; ?></option><?php
							}
						}
						?>
					</select>
					<?php
				}else{
					$message = __('lblNoPageMessage', true);
					$message = str_replace("{STAG}", '<a href="'.$_SERVER['PHP_SELF'].'?controller=pjAdminTopics&amp;action=pjActionCreate">', $message);
					$message = str_replace("{ETAG}", '</a>', $message);
					?><label class="block t5"><?php echo $message;?></label><?php
				} 
				?>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblSelectTheme');?></label>
			<span class="inline_block">
				<select name="theme" id="theme" class="pj-form-field w150">
					<?php
					$default = explode("::", $tpl['theme_arr']['value']);
					$enum = explode("|", $default[0]);
					
					$enumLabels = array();
					if (!empty($tpl['theme_arr']['label']) && strpos($tpl['theme_arr']['label'], "|") !== false)
					{
						$enumLabels = explode("|", $tpl['theme_arr']['label']);
					}
					foreach ($enum as $k => $el)
					{
						if ($default[1] == $el)
						{
							?><option value="<?php echo $el; ?>" selected="selected"><?php echo array_key_exists($k, $enumLabels) ? stripslashes($enumLabels[$k]) : stripslashes($el); ?></option><?php
						} else {
							?><option value="<?php echo $el; ?>"><?php echo array_key_exists($k, $enumLabels) ? stripslashes($enumLabels[$k]) : stripslashes($el); ?></option><?php
						}
					}
					?>
				</select>
			</span>
		</p>
		<?php
		if(count($tpl['topic_arr']) > 0)
		{
			?>
			<p>
				<label class="title">&nbsp;</label>
				<span class="inline_block">
					<input type="button" value="<?php __('btnPreview'); ?>" class="pj-button pj-button-preview"/>
					<input type="button" value="<?php __('btnGetInstallCode'); ?>" class="pj-button pj-button-get-code"/>
				</span>
			</p>
			<?php
		} 
		?>
		
		<div id="step_container" style="display:<?php echo isset($_GET['id']) ? 'block' : 'none';?>;">
		
		<p style="margin: 0 0 10px; font-weight: bold"><?php __('lblInstallPhp1_1'); ?></p>
		<textarea id="step1" class="pj-form-field w700 textarea_install" style="overflow: auto; height:70px">
&lt;?php
ob_start();
<?php echo isset($_GET['id']) ? '$PJ_TOPIC = '.$_GET['id'].'; ' : null;?>
<?php echo '$PJ_THEME = \'' . $tpl['option_arr']['o_theme'] . '\'; ' ;?>
?&gt;</textarea>
			<p style="margin: 20px 0 10px; font-weight: bold"><?php __('lblInstallPhp1_2'); ?></p>
		<textarea class="pj-form-field w700 textarea_install" style="overflow: auto; height:30px">{PC_LOAD}</textarea>
		<p style="margin: 20px 0 10px; font-weight: bold"><?php __('lblInstallPhp1_3'); ?></p>
		<textarea class="pj-form-field w700 textarea_install" style="overflow: auto; height:30px">
&lt;?php include '<?php echo dirname($_SERVER['SCRIPT_FILENAME']); ?>/app/views/pjLayouts/pjActionLoad.php'; ?&gt;</textarea>
		</div>
	</div><!-- tabs-1 -->
	
	<?php
}
?>