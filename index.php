
<?php  
$style =  get_option('cnsecer_style');
if(!empty($style) && $style == 0 ){
	include ("indexA.php");
}else if(!empty($style) && $style == 1 ){
	include ("indexB.php");
}else{
	include ("indexA.php");
}

$test = 'aaaa';
?>
