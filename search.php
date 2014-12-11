<?php get_header(); ?>
<div class="container">
	<div class="search">
	<div class="row">

		<div class="col-md-9 ">
			
			<div class="search-page global">
			<div class="tit"><h1>搜索结果:<span><?php echo $_GET['s']; ?></span></h1></div>	
			<?php $posts =  query_posts($query_string .'&ignore_sticky_posts=1&orderby=date&showposts=10');?>       
			<?php if( $posts ) : ?>                                      
			<?php while ( have_posts() ) : the_post() ;?> 
			<?php
				$title = get_the_title();
				$content = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"......");//300是摘要字符数，......是结束符号。
				$keys = explode(" ",$s);
				$title = preg_replace('/('.implode('|', $keys) .')/iu','<strong style="color:#E74C3C;">\0</strong>',$title);
				$content = preg_replace('/('.implode('|', $keys) .')/iu','<strong style="color:#E74C3C;">\0</strong>',$content);
			?>
				<div class="content">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="title">
							<a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>" ><?php echo $title ; ?></a>
						</div>
		
						<div class="clearfix"></div>
						<div class="text">
							<p><?php echo $content; ?></p>
						</div>
						<div class="clearfix"></div>
						<a href="<?php the_permalink() ?>"><?php the_permalink() ?></a>

					</div>
				</div>
				</div>
				<?php endwhile; ?>                                          
			<?php endif; ?>	
			</div>
			<div class="clearfix"></div>
			<div  id="pagination">
				<?php generalPagination($query_string); ?>
			</div>			
		</div>

		<!--sidebar begin-->
		<div class="col-md-3 hidden-sm hidden-xs global">
			<?php get_sidebar(); ?>
		</div>
		<!-- sidebar end -->
	</div>

	</div>		

</div>



<?php get_footer(); ?>