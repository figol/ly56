<?php  
/* 
Template Name:about
*/  
?> 


<?php get_header(); ?>
<style>
  .about #con{text-indent: 2em;}
</style>

<div class="container global">
	<div class="row">
   <div class="col-md-9">
    <div class="about">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <p>
          <?php the_content(); ?>          
        </p>
    <?php endwhile; endif; ?>
  </div> 
   </div>
   <div class="col-md-3 hidden-xs">
     <?php  get_sidebar(); ?>
   </div>
  </div>
</div>
<?php get_footer(); ?>