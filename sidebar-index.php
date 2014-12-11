
<div class="sidebar ">



	<div class="tit01">
		<h1>最新文章</h1>
	</div> 
		<div class="s1">	
			<ul>
			<?php 
			$args =array(/*'category_name' => 'fase,jiaocheng,biancheng',*/'showposts' => '10' );
			$query = new WP_Query( $args );
			$n=1;
			while ( $query->have_posts() ) : $query->the_post();
			?>

			<?php if($n<4):?>
				<li><span class="sp" style="background-color:#3ec491"><?php echo $n ;?></span><a title="<?php the_title(); ?>"   href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
			<?php else: ?>
				<li><span class="sp"><?php echo $n ;?></span><a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
			<?php endif ;?>

			<?php $n++; ?>
			<?php endwhile; ?> 			
			</ul>
		</div>
	<div class="tit01">
		<h1>站长推荐</h1>
	</div>
		<div class="s2">
			<?php echo stripslashes(get_option('cnsecer_sidebar-ads')); ?>
		</div>

	<div class="tit01">
		<h1>标签云</h1>
	</div>
		<div class="s3">
		<div  class="tagscloud " >
			<?php wp_tag_cloud("smallest=15&largest=25&unit=px&number=30&orderby=count&order=DESC"); ?>
		</div>
		</div>


	<!-- 小工具 -->

	<div id="sidebar-inner">
		<?php dynamic_sidebar(); ?>
	</div>


		
			
			
</div>
