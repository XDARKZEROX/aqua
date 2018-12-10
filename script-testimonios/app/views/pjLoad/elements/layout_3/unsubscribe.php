<div class="pc-container">
	<?php
	$status = $tpl['status'];
	
	$arr = __('unsubscribe_statarr', true);
	?>
	<div class="<?php echo $status == '1' ? 'pc-message' : 'pc-error';?> pc-b20"><?php echo $arr[$status]?></div>
</div>