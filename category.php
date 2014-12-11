<?php 

$waterfall = explode(",", get_option('cnsecer_waterfallStyle')); 

if ( in_category($waterfall) ) {
	include(TEMPLATEPATH . '/cate-waterfall.php');
}else { // plugin 为category的别名
	include(TEMPLATEPATH . '/cate-blog.php');
}


 ?>