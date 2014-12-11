<?php if ( is_search() ) { ?>
<title>搜索结果 - <?php bloginfo('name'); ?></title>
<meta name="description" content="搜索结果页面" />
<meta name="keywords" content="<?php echo stripslashes(get_option('cnsecer_keywords')); ?>" />
<?php } ?>

<?php if ( is_page() ) { ?>
<title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title>
<meta name="description" content="<?php echo category_description(); ?>.."/>
<meta name="keywords" content="<?php echo stripslashes(get_option('cnsecer_keywords')); ?>" />
<?php } ?>

<?php if ( is_tag() ) { ?>
<title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title>
<meta name="description" content="<?php echo category_description(); ?>.."/>
<meta name="keywords" content="<?php echo stripslashes(get_option('cnsecer_keywords')); ?>" />
<?php } ?>

<?php if ( is_category() ) { ?>
<title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?></title>
<meta name="description" content="<?php echo category_description(); ?>"/>
<meta name="keywords" content="<?php echo stripslashes(get_option('cnsecer_keywords')); ?>" />
<?php } ?>
<?php if ( is_single() ) { ?>
<title><?php echo trim(wp_title('',0)); ?> - <?php $keywords = ""; $tags = wp_get_post_tags($post->ID);  foreach ($tags as $tag ) {   $keywords = $keywords . $tag->name . ", "; } echo $keywords; ?></title>
<meta name="description" content="<?php if (is_single()){ echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 180,"");} ?>"/>
<meta name="keywords" content="<?php $keywords = ""; $tags = wp_get_post_tags($post->ID);  foreach ($tags as $tag ) {   $keywords = $keywords . $tag->name . ", "; } echo $keywords; ?>" />
<?php } ?>
<?php if ( is_home() ) { ?>
<title><?php echo stripslashes(get_option('cnsecer_title')); ?></title>
<meta name="description" content="<?php echo stripslashes(get_option('cnsecer_description')); ?>" />
<meta name="keywords" content="<?php echo stripslashes(get_option('cnsecer_keywords')); ?>" />
<?php } ?>




