

<?php $posts =  query_posts($query_string .'&orderby=date&showposts=3');?>       

<div class="slider">
    <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
      
      <?php if( $posts ) : ?>
        <?php $n=0;?>
        <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
          <?php if ( is_sticky() ) : ?>
          <?php $active = ($n==0) ? 'active' : '' ;?>      
              <div class="item <?php echo $active; ?> ">
      		    <a href="<?php the_permalink() ?>" target="_blank"><img src="<?php post_thumbnail_src();?>" alt='<?php the_title(); ?>' class="img-responsive img-rounded"></a>          
              <div class="inner">
                <p class="t"><?php the_title(); ?></p>
              </div>
              </div>     
          <?php $n++; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>

      </div>
       <a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
       </a>
      <a class="right carousel-control" href="#carousel-example-captions" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
</div>
