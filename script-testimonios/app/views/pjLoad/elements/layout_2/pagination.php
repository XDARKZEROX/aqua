<div class="pc-paging-container">
	<?php
	if (isset($tpl['paginator']))
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
		<ul class="pc-paginator">
			<?php
			$stages = 3;
			$lastpage = $tpl['paginator']['pages'];
								
			if ($page > 1)
			{
				?><li><a class="page-link link-previous" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $page - 1; ?>" ><span><?php __('front_paging_previous_2');?></span></a></li><?php
			}else{
				?><li><a class="page-link link-previous" href="javascript:void(0);" ><span><?php __('front_paging_previous_2');?></span></a></li><?php
			}
			if ($lastpage < 7 + ($stages * 2))
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					{
						?><li><a href="javascript:void(0);" class="page-node current"><span><?php echo $counter; ?></span></a></li><?php
					}else{
						?><li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>" ><span><?php echo $counter; ?></span></a></li><?php
					}
				}
			} else if ($lastpage > 5 + ($stages * 2)){
				
				if($page < 1 + ($stages * 2))		
				{
					for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
					{
						if ($counter == $page){
							?><li><a href="javascript:void(0);" class="page-node current"><span><?php echo $counter; ?></span></a></li><?php
						}else{
							?><li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>" ><span><?php echo $counter; ?></span></a></li><?php
						}	
					}
					?>
					<li class="dot"><span>...</span></li>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage - 1; ?>" ><span><?php echo $lastpage - 1; ?></span></a></li>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage; ?>" ><span><?php echo $lastpage; ?></span></a></li>
					<?php
				}else if($lastpage - ($stages * 2) > $page && $page > ($stages * 2)){
					?>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=1" ><span>1</span></a></li>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=2" ><span>2</span></a></li>
					<li class="dot"><span>...</span></li>
					<?php
					for ($counter = $page - $stages; $counter <= $page + $stages; $counter++){
						if ($counter == $page)
						{
							?><li><a href="javascript:void(0);" class="page-node current"><span><?php echo $counter; ?></span></a></li><?php
						}else{
							?><li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>" ><span><?php echo $counter; ?></span></a></li><?php
						}
					}
					?>
					<li class="dot"><span>...</span></li>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage - 1; ?>" ><span><?php echo $lastpage - 1; ?></span></a></li>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $lastpage; ?>" ><span><?php echo $lastpage; ?></span></a></li>
					<?php
				}else{
					?>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=1" ><span>1</span></a></li>
					<li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=2" ><span>2</span></a></li>
					<li class="dot"><span>...</span></li>
					<?php
					for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
						{
							?><li><a href="javascript:void(0);" class="page-node current"><span><?php echo $counter; ?></span></a></li><?php
						}else{
							?><li><a class="page-node" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $counter; ?>" ><span><?php echo $counter; ?></span></a></li><?php
						}
					}
				}	
			}
			if ($page < $counter - 1){
				 ?><li><a class="page-link link-next" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_string;?>&amp;pjPage=<?php echo $page + 1; ?>" ><span><?php __('front_paging_next');?></span></a></li><?php
			}else{
				?><li><a class="page-link link-next" href="javascript:void(0);" ><span><?php __('front_paging_next');?></span></a></li><?php
			}
			?>
		
		</ul>
		<?php
	} 
	?>
</div>