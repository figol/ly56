<?php get_header(); ?>

<!-- 内容开始 -->

<div class="container">
<div class="category">
<div class="row">
<div class="col-md-9 col-sm-12">
	
	<!--main begin-->
	<div class="main global">
	
		<!-- 最新文章开始 -->
		<div class="tit">
			<h1>
			<?php if (function_exists('cate_nav')) cate_nav(); ?>
			</h1>
		</div>
		<div id="posts">
		<?php $posts =  query_posts($query_string .'&ignore_sticky_posts=1&orderby=date&showposts=10');?>       
		<?php if( $posts ) : ?>                                      
		<?php while ( have_posts() ) : the_post() ;?> 
		<div class="content onepost">
		<div class="row">
			<div class="col-md-4 col-sm-4 hidden-xs">
				<div class="thumb">
					<a href="<?php the_permalink() ?>" ><img data-original="<?php post_thumbnail_src();?>"  alt='<?php the_title(); ?>' class="lazy img-responsive img-rounded"></a>
					
				</div>
			</div>
			<div class="col-md-8 col-sm-8">
				<dl>
					<div class="title">
						<a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</div>
					<dd>
						<p><?php echo mb_strimwidth(strip_tags($post->post_content), 0,280,"..."); ?></p>
					</dd>
					<div class="info hidden-xs">
						 <div class="tags">
						<span class="mlabel-success">Tags:</span>
					
						<?php
						$posttags = get_the_tags();
						$n = 1;
						if ($posttags) {
						  foreach($posttags as $tag) {
						  	if($n<3)echo  '<span class="mlabel-info">'.$tag->name.'</span>';
							$n++;
						  }
						}
						?>
					
						 </div> 
					 	 <div class="views"><span class="mlabel-info"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">View More</a></span></div>

					 </div>
				</dl>
			</div>
		</div>
		</div>
		<?php endwhile; ?>                                          
	<?php endif; ?>	
	</div>
	</div>		


	<div class="clearfix"></div>
	<div class="ajax_btn">
		<!--动态载入-->
		<?php if ( $wp_query->max_num_pages > 1 ): ?>
		<div class="aload">
			<?php next_posts_link( __( '点击载入更多内容', 'bubu' ) ); ?>
		</div>
		<?php endif; ?>
	</div>			


	</div>
	<!--main end-->
	
	<!--sidebar begin-->
	<div class="col-md-3 hidden-sm hidden-xs global">
		<?php get_sidebar(); ?>
	</div>
	<!-- sidebar end -->
</div>
</div>

</div>

<?php get_footer(); ?>