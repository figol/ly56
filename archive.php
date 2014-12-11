<?php  
/* 
Template Name:archive
*/  
?> 
<?php clear_all_cache() ?>

<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-9 ">
				<div id="archives" class=" global">
				<div class="tit">
					<h1>文章归档(点击月份可展开和折叠菜单)</h1>
				</div>
					
						
		             <ul class="all_post_list"> 
			             <div class="panel-group" id="accordion">
			                 <?php cnsecer_archives_list(); ?>
			             </div>
		             </ul>
		             
							
				</div>
			</div>
			<div class="col-md-3 hidden-xs hidden-sm global">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>




</div>	


<?php get_footer(); ?>