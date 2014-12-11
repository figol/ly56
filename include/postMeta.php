<?php
/*
* 在这里添加我们的自定义字段
*
* Link:http://www.cnsecer.com/2974.html
*/
 
// 设置自定义字段的留空时（没有设置时）的默认值
 
$demo_def = "";
$download_one_def = "";
$download_two_def = "";
$download_def ="";

$demo = get_post_meta($post->ID, 'demo', true);
$download_one = get_post_meta($post->ID, 'download_one', true);
$download_two = get_post_meta($post->ID, 'download_two', true);
$download  = get_post_meta($post->ID, 'download', true);
// 检查这个字段是否有值
if (empty ( $demo)) { //如果值为空，输出默认值
	$demo = $demo_def;
}

if (empty ( $download_one)) { //如果值为空，输出默认值
	$download_one = $download_one_def;
}

if (empty ( $download_two)) { //如果值为空，输出默认值
	$download_two = $download_def;
}

if (empty ( $download)) { //如果值为空，输出默认值
	$download = $download_def;
}
//如果不为空 则输出
if(!empty($download_one)){

	echo "<h3>预览和下载</h3>";

	echo '
	    <div class="btn_demo">
	        <a target="_blank" href=" ';  echo $demo; echo ' "> 
	          <span>演示地址</span>
	        </a>
		</div> ';

	echo '
	    <div class="btn_download">
	        <a target="_blank" href=" ';  echo $download_one; echo ' "> 
	          <span>主题下载</span>
	        </a>
		</div> ';

	echo '
	    <div class="btn_download">
	        <a target="_blank" href=" ';  echo $download_two; echo ' "> 
	          <span>备胎下载</span>
	        </a>
		</div> ';
	echo '<div class="clearfix"> </div>';
}


if(!empty($download)){

	echo "<h3>下载</h3>";

	echo '
	    <div class="btn_download">
	        <a target="_blank" href=" ';  echo $download; echo ' "> 
	          <span>文件下载</span>
	        </a>
		</div> ';

	echo '<div class="clearfix"> </div>';
}


?>

