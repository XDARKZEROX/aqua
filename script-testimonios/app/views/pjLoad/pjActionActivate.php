<div id="pjWrapperPostComment_<?php echo $controller->getTopic();?>">
	<div class="container-fluid pjCpContainer">
		<div class="row">
			<div class="col-md-12">
				<br/>
				<?php
				$status = $tpl['status'];
				
				$activation_messages = __('front_activation_message', true);
				?>
				<div class="alert alert-<?php echo $status == 'FA01' ? 'success' : 'warning';?>" role="alert"><?php echo $activation_messages[$status]?></div>
			</div><!-- /.col-md-10 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid pjCpContainer -->
</div><!-- /#pjWrapper -->
