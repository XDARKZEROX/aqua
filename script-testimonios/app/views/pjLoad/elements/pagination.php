<nav class="pjCpPagination">
	<?php
	if (isset($tpl['paginator']) && $tpl['paginator']['pages'] > 1)
	{		
		$page = 1 ;
		$query_string = $_SERVER['QUERY_STRING'];
		if(empty($query_string)){
			$query_string = "controller=pjLoad&amp;action=pjActionIndex";
		}
		if(isset($_GET['pjPage'])){
			$page = $_GET['pjPage'];
			$query_string = str_replace("&pjPage=" . $page, "", $query_string);
		}
		?>
		<ul class="pagination">
			<?php
			$stages = 3;
			$lastpage = $tpl['paginator']['pages'];
								
			if ($page > 1)
			{
				?><li><a class="pjCpBtn" aria-label="Previous" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $page - 1; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span aria-hidden="true">&laquo; <?php __('front_paging_previous');?></span></a></li><?php
			}else{
				?><li><a class="pjCpBtn" aria-label="Previous" href="javascript:void(0);" ><span aria-hidden="true">&laquo; <?php __('front_paging_previous');?></span></a></li><?php
			}
			if ($lastpage < 7 + ($stages * 2))
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					{
						?><li><a href="javascript:void(0);" class="pjCpBtn pjCpBtnCurrent"><span><?php echo $counter; ?></span></a></li><?php
					}else{
						?><li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $counter; ?></span></a></li><?php
					}
				}
			} else if ($lastpage > 5 + ($stages * 2)){
				
				if($page < 1 + ($stages * 2))		
				{
					for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
					{
						if ($counter == $page){
							?><li><a href="javascript:void(0);" class="pjCpBtn pjCpBtnCurrent"><?php echo $counter; ?></a></li><?php
						}else{
							?><li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $counter; ?></span></a></li><?php
						}	
					}
					?>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage - 1; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $lastpage - 1; ?></span></a></li>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $lastpage; ?></span></a></li>
					<?php
				}else if($lastpage - ($stages * 2) > $page && $page > ($stages * 2)){
					?>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=1#pjCpComment_<?php echo $controller->getTopic();?>" ><span>1</span></a></li>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=2#pjCpComment_<?php echo $controller->getTopic();?>" ><span>2</span></a></li>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<?php
					for ($counter = $page - $stages; $counter <= $page + $stages; $counter++){
						if ($counter == $page)
						{
							?><li><a href="javascript:void(0);" class="pjCpBtn pjCpBtnCurrent"><span><?php echo $counter; ?></span></a></li><?php
						}else{
							?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $counter; ?></span></a></li><?php
						}
					}
					?>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage - 1; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $lastpage - 1; ?></span></a></li>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $lastpage; ?></span></a></li>
					<?php
				}else{
					?>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=1#pjCpComment_<?php echo $controller->getTopic();?>" ><span>1</span></a></li>
					<li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=2#pjCpComment_<?php echo $controller->getTopic();?>" ><span>2</span></a></li>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<li class="dot">.</li>
					<?php
					for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
						{
							?><li><a href="javascript:void(0);" class="pjCpBtn pjCpBtnCurrent"><span><?php echo $counter; ?></span></a></li><?php
						}else{
							?><li><a class="pjCpBtn" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span><?php echo $counter; ?></span></a></li><?php
						}
					}
				}	
			}
			if ($page < $counter - 1){
				 ?><li><a class="pjCpBtn" aria-label="Next" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $page + 1; ?>#pjCpComment_<?php echo $controller->getTopic();?>" ><span aria-hidden="true"><?php __('front_paging_next');?> &raquo;</span></a></li><?php
			}else{
				?><li><a class="pjCpBtn" aria-label="Next" href="javascript:void(0);" ><span aria-hidden="true"><?php __('front_paging_next');?> &raquo;</span></a></li><?php
			}
			?>
		</ul>
		<?php
	} 
	?>
</nav><!-- /.pjCpPagination -->