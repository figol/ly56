<?php  
/* 
Template Name:links
*/  
?> 


<?php get_header(); ?>


<div class="container global">
	<div class="row">
   <div class="col-md-9">
    <div class="flinks">
    <h2>友情链接</h2>

  <div class="page-links">
      <ul>
          <?php
          $default_ico =  get_template_directory_uri().'/images/links_default.gif'; 
          $bookmarks = get_bookmarks('orderby=url'); 
          ?>
          <?php if(!empty($bookmarks)): ?>
          <?php foreach ($bookmarks as $bookmark): ?>

              <li>
                <img src="<?php echo $bookmark->link_url ?>/favicon.ico" alt="<?php echo $bookmark->link_name ?>" onerror="javascript:this.src='<?php echo $default_ico; ?>'">
                <a target="_blank" href="<?php echo $bookmark->link_url ?>"><?php echo $bookmark->link_name ?></a>
              </li>
          <?php endforeach ?>
          <?php endif ;?>
      </ul>
  </div>



    <div class="clearfix"></div>
    <h2>友链申请</h2>
      <p>1、申请友链之前请在贵站加上本站链接,然后在下面留言并给出贵站信息</p>
      <p>2、如果条件符合,我看到留言后变回添加贵站链接</p>
    <h2>本站信息</h2>
      <blockquote>
      <p>名称：wordpress主题</p>
      <p>地址：<a href="http://www.cnsecer.com/" title="安全者">http://www.cnsecer.com/</a> </p>
      </blockquote>
    </div> 
<div id="comments"><?php comments_template(); ?></div>  
   </div>
   <div class="col-md-3 hidden-xs">
     <?php  get_sidebar(); ?>
   </div>
  </div>
</div>
<?php get_footer(); ?>