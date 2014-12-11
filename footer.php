

<div class="footer">
	<div class="fbody hidden-xs hidden-sm">

	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h3>友情链接</h3>
				<ul class="links">
	 				<?php wp_list_bookmarks('orderby=rating&limit=15&categorize=0&category=&title_li='); ?>
				</ul>
			</div>
			<div class="col-md-3">
				<h3>联系方式</h3>
				<ul>
					<li>QQ群: <span><?php echo stripslashes(get_option('cnsecer_qun')); ?></span> </li>
					<li>邮箱: <span><?php echo stripslashes(get_option('cnsecer_email')); ?></span> </li>
					<li>Q Q: <span><?php echo stripslashes(get_option('cnsecer_qq')); ?></span> </li>
				</ul>
			</div>
			<div class="col-md-3">
				<h3>关于本站</h3>
				<ul>
					<?php wp_list_pages( array('title_li' => FALSE ) ); ?>
				</ul>
			</div>
			<div class="col-md-3">
				<h3>关注我们</h3>
				<?php $code = get_option('cnsecer_code') ?>
				<?php if (empty($code)): ?>
					<img src="<?php bloginfo('template_directory'); ?>/images/code.jpg" alt="QQ群"> 
				<?php else: ?>
					<img src="<?php echo $code; ?>" alt="QQ群"> 
				<?php endif ?>
				 
				<ul class="social">

					<a target="_blank" href="http://weibo.com/<?php echo stripslashes(get_option('cnsecer_weibo')); ?>"><i class="weibo"></i></a>
					<a target="_blank" href="http://git.oschina.net/<?php echo stripslashes(get_option('cnsecer_osc')); ?>"><i class="github"></i></a>
					<a target="_blank" href="http://t.qq.com/<?php echo stripslashes(get_option('cnsecer_tweibo')); ?>"><i class="tweibo"></i></a>
				    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo stripslashes(get_option('cnsecer_qq')); ?>&site=qq&menu=yes"><i class="qq"></i></a>
													

				</ul>
			</div>
		</div>
	</div>
	
	</div>
	
</div>
<!-- 返回顶部等工具栏 -->
<div id="tbox" class="hidden-xs hiddem-sm"> 
<?php wp_reset_query();if ( !is_home()) { ?>
	<a id="home" rel="nofollow" href="<?php bloginfo('siteurl');?>" title="返回主页"></a> 
<?php } ?>
<?php wp_reset_query();if ( !is_single()) { ?>
	<a id="pinglun" href="<?php bloginfo('siteurl');?>/guestbook" title="留言板"></a> 
<?php } ?>
<?php wp_reset_query();if ( is_single()) { ?>
	<a id="pinglun" href="#comments" rel="nofollow" title="留言"></a> 
<?php } ?>	
	<a id="gotop" href="javascript:void(0)" rel="nofollow" style="display: block;" title="返回顶部"></a> 
</div>
<!-- 返回顶部等工具栏 -->  
<script src="<?php bloginfo('template_directory'); ?>/flatui/js/jquery-1.10.2.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/flatui/js/bootstrap.min.js"></script>

<?php wp_reset_query();if ( is_single()) { ?>
<script src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"  type="text/javascript"></script>
<?php } ?>
<script src="<?php bloginfo('template_directory'); ?>/js/app.js?date=20140513" type="text/javascript"></script>
<?php if (!is_mobile() ): ?>
<script type="text/javascript">
$(function($) {
    $(document).ready(function() {
        $('header').stickUp();
    });
});
</script> 
<?php endif ;?>

<?php echo stripslashes(get_option('cnsecer_share')); ?>
</body>
</html>
