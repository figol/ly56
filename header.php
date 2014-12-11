<!doctype html>   
<html lang="zh-cn">
<head> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta  charset="<?php bloginfo('charset'); ?>" />
<!--seo begin-->
<?php include(TEMPLATEPATH . '/include/seo.php'); ?>
<!--seo end-->
<?php  
$logo =get_option('cnsecer_logo');
$favicon =get_option('cnsecer_favicon');
?>

<?php if (empty($favicon)): ?>
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />
<?php else: ?>		
	<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon" />	
<?php endif ?>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/flatui/bootstrap/css/bootstrap.css"  media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/flatui/css/flat-ui.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>?time=20140514"/>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_directory'); ?>/flatui/js/html5shiv.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/flatui/js/respond.min.js"></script>
<![endif]--> 
<?php wp_head(); ?>
<?php do_action("wp_footer"); ?>
<style>
	<?php echo stripslashes(get_option('cnsecer_style')); ?>
</style>
</head>
	<body <?php body_class(); ?>>
	<!-- 头部开始 -->
	<div class="header"> 
		<div class="topBar hidden-xs">
			<div class="container">
				<ul class="login_wrap">
					<?php wp_list_pages( array('title_li' => FALSE)); ?>
				</ul>

				<div class="toolBar">
					<ul>
						<li><a target="_blank" class="icon1" href="<?php bloginfo('siteurl');?>/archive/"><span class="hover" style="opacity: 0;"></span></a></li>						
						<li><a target="_blank" class="icon3" href="<?php bloginfo('siteurl');?>/sitemap.xml"><span class="hover" style="opacity: 0;"></span></a></li>					
						<li><a target="_blank" class="icon4" href="http://t.qq.com/<?php echo stripslashes(get_option('cnsecer_tweibo')); ?>"><span class="hover" style="opacity: 0;"></span></a></li>							
						<li><a target="_blank" class="icon2" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo stripslashes(get_option('cnsecer_qq')); ?>&site=qq&menu=yes"><span class="hover" style="opacity: 0;"></span></a></li>						
						<li><a target="_blank" class="icon5" href="http://weibo.com/<?php echo stripslashes(get_option('cnsecer_weibo')); ?>"><span class="hover" style="opacity: 0;"></span></a></li>						
					</ul>		
				</div>
			</div>
		</div>
		<!-- top begin -->
		<div class="htop hidden-xs">
		<div class="container">
			<div class="logo " data-toggle="tooltip" data-placement="right" data-original-title="<?php echo stripslashes(get_option('cnsecer_tips')); ?>" >
				<a href="<?php bloginfo('siteurl');?>">
				<?php if (empty($logo)): ?>
					<img src="<?php echo get_bloginfo("template_url"); ?>/images/logo.png" alt="<?php bloginfo('name');?>" />	
				<?php else: ?>
					<img src="<?php echo $logo;?>" alt="<?php bloginfo('name');?>" />		
				<?php endif ?>
				
				</a>	
			</div> 
			<?php $alert=get_option('cnsecer_alert'); ?>
			<?php if (!empty($alert)): ?>
			<div class="fuck visible-md visible-sm visible-lg alert alert-success alert-dismissable" style="">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			 	<?php echo $alert; ?>
			</div>
			<?php endif ?>
			<div id="tads">			
				<?php echo stripslashes(get_option('cnsecer_top_ads')); ?>
			</div>

		</div>
		</div>
		<!-- top end -->
		<!-- 头部导航开始 -->
		<header   class="headroom navbar navbar-inverse navbar-fixed-top" role="banner navigation" >
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand visible-xs" href="<?php bloginfo('siteurl');?>">安全者</a>
				</div>
				
				<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">	
					<?php bootstrap_nav(); ?>	
			    <!-- search box begin -->
				<ul class="nav navbar-nav navbar-right">           
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"></span></b></a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                    <li>
					    <form  method="get"   action="<?php echo home_url( '/' ); ?>"  class="navbar-form navbar-left" role="search"> 
						<div class="form-group">
							<input type="text" name="s" class="form-control" placeholder="Search"  x-webkit-speech="">
						</div>
					    </form>	
                    </li>
                  </ul>
                </li>
               </ul>			    
			    <!-- search box end -->
			    </nav>
			</div>
		</header>
		<!-- 头部导航结束 -->
		


	</div>
	<!-- 头部结束 -->

	
