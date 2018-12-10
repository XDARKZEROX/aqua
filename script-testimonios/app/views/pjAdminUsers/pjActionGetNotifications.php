<?php
if($_GET['name'] == 'notify_email')
{ 
	?>
	<select name="<?php echo $_GET['name']; ?>[]" multiple="multiple" class="w400" data-placeholder="<?php __('lblChoose'); ?>">
	<?php
	$forbidden = array();
	if ((int) $_GET['role_id'] === 2)
	{
		$forbidden = array(4);
	}
	foreach (__('notify_email', true) as $k => $v)
	{
		if (in_array($k, $forbidden))
		{
			continue;
		}
		if($_GET['action_name'] == 'user_update')
		{
			?><option value="<?php echo $k; ?>"<?php echo isset($tpl['arr']) && in_array($k, $tpl['arr']) ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
		}else{
			?><option value="<?php echo $k; ?>"<?php echo $k == 1 ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
		}
	}
	?>
	</select>
	<?php
}else if($_GET['name'] == 'notify_sms'){
	?>
	<select name="<?php echo $_GET['name']; ?>[]" multiple="multiple" class="w400" data-placeholder="<?php __('lblChoose'); ?>">
	<?php
	$forbidden = array();
	if ((int) $_GET['role_id'] === 2)
	{
		$forbidden = array();
	}
	foreach (__('notify_sms', true) as $k => $v)
	{
		if (in_array($k, $forbidden))
		{
			continue;
		}
		if($_GET['action_name'] == 'user_update')
		{
			?><option value="<?php echo $k; ?>"<?php echo isset($tpl['arr']) && in_array($k, $tpl['arr']) ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
		}else{
			?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
		}
	}
	?>
	</select>
	<?php
} 
?>