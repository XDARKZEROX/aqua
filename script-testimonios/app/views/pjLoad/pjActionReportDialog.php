<p><?php __('front_label_report_comment');?></p>
<ul>
	<?php
	$report_cases = __('front_report_case', true);
	foreach($report_cases as $key => $value)
	{ 
		?>
		<li><?php echo $value?></li>
		<?php
	} 
	?>
</ul>
<button type="button" class="btn btn-default" onclick="PC.Utils.submitReport('<?php echo $tpl['comment_id']?>');"><?php __('front_button_report');?></button>
<button type="button" class="btn btn-default" onclick="TINY.box.hide();"><?php __('front_button_cancel');?></button>