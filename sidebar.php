
<div class="sidebar">
  
	<div class="tit01">
		<h1>置顶文章</h1>
	</div>

		<div class="s1">
		<ul>
		<?php include(TEMPLATEPATH . '/include/stickyPost.php'); ?>
		</ul>
		</div>
	
	<div class="tit01">
		<h1>标签云</h1>
	</div>
		<div class="s3">
			<div class="tagscloud">
			<?php wp_tag_cloud("smallest=15&largest=25&unit=px&number=30&orderby=count&order=DESC"); ?>
			</div>
		</div>
 
	<div class="tit01">
		<h1>支持本站</h1>
	</div>
		<div class="s2">
			<?php echo stripslashes(get_option('cnsecer_sidebar-ads')); ?>
		</div>

</div>
