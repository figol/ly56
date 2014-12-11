<?php get_header(); ?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!--内容开始-->
<div class="container" >
<div class="row">
<div class="col-md-9">
  <!-- single begin -->
  <div class="single global">
    <div class="top">
      <h2 class="title"><a href="<?php the_permalink() ?>" target="_blank"><?php the_title(); ?></a></h2>
      <div class="clearfix"></div>
      <div class="info">
          <span class="glyphicon glyphicon-user"><b><?php the_author_posts_link(); ?> </b></span>
          <span class="glyphicon glyphicon-calendar"><b><?php the_time('20y-m-d')?></b> </span>
          <span class="glyphicon glyphicon-comment"><b><?php comments_popup_link ('暂无评论','1条评论','%条评论'); ?></b> </span>
          <span class="glyphicon glyphicon-list"><b><?php the_category(' '); ?></b></span>  
         <?php if( is_user_logged_in() ) : ?>
          <span class="glyphicon glyphicon-wrench"><b><?php edit_post_link('编辑');?></b></span>
         <?php endif; ?>  
          <span class="glyphicon glyphicon-eye-open"><b><?php echo getPostViews(get_the_ID()); ?></b></span>
      </div>
    </div>
	<div class="clearfix"></div>
	<!--
  <div class="ads hidden-xs ">
    <?php echo stripslashes(get_option('cnsecer_single-ads')); ?>
  </div>
    -->

    <div class="article">
      <?php setPostViews(get_the_ID()); /*浏览次数*/ ?> 
      <?php the_content(); ?>
      <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
      <?php endwhile; endif; ?>
      <?php  include(TEMPLATEPATH . '/include/postMeta.php');  ?>
 
      <div class="clearfix"></div>
      <div class="article-footer alert alert-danger">
        <div class="copyright hidden-xs">
         <span>如果文章内容对你有帮助,请点下本站的广告以表支持,谢谢!</span> 
        </div>
         <div class="copyright visible-xs">
         <span>转载请注明出自<a href="http://www.cnsecer.com">CNSECER.COM</a></span>
          
        </div>
        <div class="tags hidden-xs hidden-sm">
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
      

      </div>
	  <div class="clearfix"></div>

     <!-- 上下页开始 -->
    <div class="post_link">
      <div class="prev hidden-xs">
      <?php previous_post_link('<span class="glyphicon glyphicon-chevron-left"></span> %link') ?>
      </div>
      <div class="next hidden-xs">
      <?php next_post_link('%link <span class="glyphicon glyphicon-chevron-right"></span> ') ?>
      </div>
    </div>
    <!-- 上下页结束 -->      

    </div>
  </div>

  <div class="clearfix"></div>
  <?php include(TEMPLATEPATH . '/include/relatedPosts.php'); ?>
  <div class="clearfix"></div>


  <!-- 评论开始 -->
  <div class="comments global">
    <div id="comments"><?php comments_template(); ?></div>  
  </div>
  <!-- 评论结束 -->
  </div>
  <!-- single end -->
  <!-- sidebar begin -->
  <div class="col-md-3 hidden-xs hidden-sm global">
    <?php get_sidebar('single'); ?>
  </div>
  <!-- sidebar end -->
 </div> 

</div>
<!--内容结束-->


<?php get_footer(); ?>

