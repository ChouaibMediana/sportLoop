<?php
/**
 * The template part for displaying page content
 *
 * @package VW Fitness Gym
 * @subpackage vw-fitness-gym
 * @since VW Fitness Gym 1.0
 */
?>

<div class="content-vw">
  <?php if(has_post_thumbnail()) {?>
    <?php the_post_thumbnail(); ?>
    <hr>
  <?php }?>
  <h1 class="vw-page-title"><?php the_title();?></h1>
  <div class="entry-content"><?php the_content();?></div>
  <div class="clearfix"></div>
    <?php wp_link_pages(); ?>
  <?php
      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
         comments_template();
      endif;
  ?>
  <div class="clearfix"></div>
</div>