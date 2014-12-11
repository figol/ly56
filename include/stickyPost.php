
<?php $posts =  query_posts($query_string .'&orderby=date&showposts=10');?>           
  <?php if( $posts ) : ?>
    <?php $n=1; ?>
    <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
      <?php if ( is_sticky() ) : ?>
      <?php $active = ($n==0) ? 'active' : '' ;?>      
      <?php if($n<4):?>
        <li><span class="sp" style="background-color:#3ec491"><?php echo $n ;?></span><a  href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
      <?php else: ?>
        <li><span class="sp"><?php echo $n ;?></span><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
      <?php endif ;?>

      <?php $n++; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>
