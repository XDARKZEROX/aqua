<div id="pjWrapperPostComment_<?php echo $controller->getTopic();?>">
	<div class="container-fluid pjCpContainer">
		<div class="row">
			<div class="col-md-12">
				<br/>
				<?php
				$status = $tpl['status'];
				
				$arr = __('unsubscribe_statarr', true);
				?>
				<div class="alert alert-<?php echo $status == '1' ? 'success' : 'warning';?>" role="alert"><?php echo $arr[$status]?></div>
			</div><!-- /.col-md-10 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid pjCpContainer -->
</div><!-- /#pjWrapper -->