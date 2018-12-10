<div class="pc-container pc-form">
	<div class="pc-error">
		<?php
		if($_GET['err'] == '0')
		{ 
			echo __('front_label_notopic', true);
		}else{
			echo __('front_label_inactive_topic', true);
		}
		?>
	</div>
</div>