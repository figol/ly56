

<div class="sidebar">

 
	<div class="tit01">
		<h1>相关文章</h1>
	</div>

		<div class="s1">
		<ul>
		<?php getRelatedPosts(); ?>
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
		<h1>随机文章</h1>
	</div>
		<div class="s4">
 
	    <?php query_posts('showposts=8&orderby=rand'); ?>  
	     
	     <ul>
	     <?php $n=1; ?>
	    <?php while (have_posts()) : the_post(); ?>  
			<?php if($n<4):?>
				<li><span class="sp" style="background-color:#3ec491"><?php echo $n ;?></span><a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
			<?php else: ?>
				<li><span class="sp"><?php echo $n ;?></span><a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
			<?php endif ;?>

			<?php $n++; ?>
	    <?php endwhile;?>  
	    </ul>	
		</div>
	<div class="tit01">
		<h1>支持本站</h1>
	</div>
		<div class="s2">
			<?php echo stripslashes(get_option('cnsecer_sidebar-ads')); ?>
		</div>
</div>
