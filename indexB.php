<?php get_header(); ?>

<!-- 瀑布流样式 -->
<div class="container waterfall">
	<div class="row">
		<div class="col-md-9">
			
			<div id="posts">
			<?php //$query_string=''; ?>
			<?php $posts =  query_posts($query_string .'&category_name=&ignore_sticky_posts=1&orderby=date&showposts=10');?>       
			<?php if( $posts ) : ?> 
			<?php while ( have_posts() ) : the_post() ;?>         

			<div id="post-<?php the_ID() ?>" class="onepost col-md-4 col-xs-12">
				<div class="box">
				<div class="thumb">
					<a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>" >
					<img data-original="<?php post_thumbnail_src();?>" alt='<?php the_title(); ?>' class="lazy img-responsive img-rounded">
					</a>
				</div>
				<div class="title">
					<a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					<div class="arrow-catpanel-top">&nbsp;</div>
				</div>
				<div class="info">
					<li class="glyphicon glyphicon-dashboard"></li> <span><?php the_time('m-d')?></span>
					<li class="glyphicon glyphicon-eye-open"></li><span><?php echo getPostViews(get_the_ID()); ?></span>
					<li class="glyphicon glyphicon-th-list"></li><span><?php the_category(' '); ?></span>
				</div>
				</div>
			</div>	

			<?php endwhile; ?> 
			<?php endif; ?>
			</div>		
			 
			<div class="ajax_btn">
				<!--动态载入-->
				<?php if ( $wp_query->max_num_pages > 1 ): ?>
				<div class="aload">
					<?php next_posts_link( __( '点击载入更多内容', 'bubu' ) ); ?>
				</div>
				<?php endif; ?>
			</div>		

		</div>

		<div class="col-md-3 hidden-xs global">
			<?php get_sidebar('index'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>

