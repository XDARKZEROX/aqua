<div class="pc-container">
	<?php
	$status = $tpl['status'];
	
	$activation_messages = __('front_activation_message', true);
	?>
	<div class="<?php echo $status == 'FA01' ? 'pc-message' : 'pc-error';?> pc-b20"><?php echo $activation_messages[$status]?></div>
</div>