<div id="pjWrapperPostComment_<?php echo $controller->getTopic();?>">
	<div class="container-fluid pjCpContainer">
		<div class="row">
			<div class="col-md-12">
				<br>
				<div class="alert alert-warning" role="alert">
					<?php
					if($_GET['err'] == '0')
					{ 
						echo __('front_label_notopic', true);
					}else{
						echo __('front_label_inactive_topic', true);
					}
					?>
				</div>
			</div><!-- /.col-md-10 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid pjCpContainer -->
</div><!-- /#pjWrapper -->