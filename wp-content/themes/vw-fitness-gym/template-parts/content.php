<?php
/**
 * The template part for displaying post
 *
 * @package VW Fitness Gym 
 * @subpackage vw-fitness-gym
 * @since VW Fitness Gym 1.0
 */
?>
<?php 
  $vw_fitness_gym_archive_year  = get_the_time('Y'); 
  $vw_fitness_gym_archive_month = get_the_time('m'); 
  $vw_fitness_gym_archive_day   = get_the_time('d'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box wow pulse delay-1000" data-wow-duration="2s">
    <?php $vw_fitness_gym_theme_lay = get_theme_mod( 'vw_fitness_gym_blog_layout_option','Default');
    if($vw_fitness_gym_theme_lay == 'Default'){ ?>
      <div class="row m-0">
        <?php if(has_post_thumbnail() && get_theme_mod( 'vw_fitness_gym_featured_image_hide_show',true) == 1) {?>
          <div class="box-image col-lg-6 col-md-6">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>
        <div class="new-text <?php if(has_post_thumbnail() && get_theme_mod( 'vw_fitness_gym_featured_image_hide_show',true) == 1) { ?>col-lg-6 col-md-6"<?php } else { ?>col-lg-12 col-md-12"<?php } ?>>
          <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
          <?php if( get_theme_mod( 'vw_fitness_gym_toggle_postdate',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_author',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_comments',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_time',true) == 1) { ?>
            <div class="post-info">
              <?php if(get_theme_mod('vw_fitness_gym_toggle_postdate',true)==1){ ?>
                <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_postdate_icon','fas fa-calendar-alt')); ?>"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_fitness_gym_archive_year, $vw_fitness_gym_archive_month, $vw_fitness_gym_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
              <?php } ?>

              <?php if(get_theme_mod('vw_fitness_gym_toggle_author',true)==1){ ?>
                 <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_author_icon','far fa-user')); ?>"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
              <?php } ?>

              <?php if(get_theme_mod('vw_fitness_gym_toggle_comments',true)==1){ ?>
                <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_comments_icon','fas fa-comments')); ?>"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'vw-fitness-gym'), __('0 Comments', 'vw-fitness-gym'), __('% Comments', 'vw-fitness-gym') ); ?> </span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
              <?php } ?>

              <?php if(get_theme_mod('vw_fitness_gym_toggle_time',true)==1){ ?>
                 <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_time_icon','far fa-clock')); ?>"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
              <?php } ?>
              <?php vw_fitness_gym_edit_link(); ?>
              <hr>
            </div>
          <?php } ?>
          <div class="entry-content">
            <p>
              <?php $vw_fitness_gym_theme_lay = get_theme_mod( 'vw_fitness_gym_excerpt_settings','Excerpt');
              if($vw_fitness_gym_theme_lay == 'Content'){ ?>
                <?php the_content(); ?>
              <?php }
              if($vw_fitness_gym_theme_lay == 'Excerpt'){ ?>
                <?php if(get_the_excerpt()) { ?>
                  <p><?php $vw_fitness_gym_excerpt = get_the_excerpt(); echo esc_html( vw_fitness_gym_string_limit_words( $vw_fitness_gym_excerpt, esc_attr(get_theme_mod('vw_fitness_gym_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('vw_fitness_gym_excerpt_suffix',''));?></p>
                <?php }?>
              <?php }?>
            </p>
          </div>
          <?php if( get_theme_mod('vw_fitness_gym_button_text','Read More') != ''){ ?>
            <div class="more-btn">
              <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_fitness_gym_button_text',__('Read More','vw-fitness-gym')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_fitness_gym_button_text',__('Read More','vw-fitness-gym')));?></span></a>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php }else if($vw_fitness_gym_theme_lay == 'Center'){ ?>
      <div class="service-text">
        <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <?php if( get_theme_mod( 'vw_fitness_gym_featured_image_hide_show',true) == 1) { ?>
          <div class="box-image">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>
        <?php if( get_theme_mod( 'vw_fitness_gym_toggle_postdate',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_author',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_comments',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_time',true) == 1) { ?>
          <div class="post-info">
            <?php if(get_theme_mod('vw_fitness_gym_toggle_postdate',true)==1){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_postdate_icon','fas fa-calendar-alt')); ?>"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_fitness_gym_archive_year, $vw_fitness_gym_archive_month, $vw_fitness_gym_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
            <?php } ?>

            <?php if(get_theme_mod('vw_fitness_gym_toggle_author',true)==1){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_author_icon','far fa-user')); ?>"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
            <?php } ?>

            <?php if(get_theme_mod('vw_fitness_gym_toggle_comments',true)==1){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_comments_icon','fas fa-comments')); ?>"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'vw-fitness-gym'), __('0 Comments', 'vw-fitness-gym'), __('% Comments', 'vw-fitness-gym') ); ?> </span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
            <?php } ?>

            <?php if(get_theme_mod('vw_fitness_gym_toggle_time',true)==1){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_time_icon','far fa-clock')); ?>"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
            <?php } ?>
            <?php vw_fitness_gym_edit_link(); ?>
            <hr>
          </div>
        <?php } ?>
        <div class="entry-content">
          <p>
            <?php $vw_fitness_gym_theme_lay = get_theme_mod( 'vw_fitness_gym_excerpt_settings','Excerpt');
            if($vw_fitness_gym_theme_lay == 'Content'){ ?>
              <?php the_content(); ?>
            <?php }
            if($vw_fitness_gym_theme_lay == 'Excerpt'){ ?>
              <?php if(get_the_excerpt()) { ?>
                <p><?php $vw_fitness_gym_excerpt = get_the_excerpt(); echo esc_html( vw_fitness_gym_string_limit_words( $vw_fitness_gym_excerpt, esc_attr(get_theme_mod('vw_fitness_gym_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('vw_fitness_gym_excerpt_suffix',''));?></p>
              <?php }?>
            <?php }?>
          </p>
        </div>
        <?php if( get_theme_mod('vw_fitness_gym_button_text','Read More') != ''){ ?>
          <div class="more-btn">
            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_fitness_gym_button_text',__('Read More','vw-fitness-gym')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_fitness_gym_button_text',__('Read More','vw-fitness-gym')));?></span></a>
          </div>
        <?php } ?>
      </div>
    <?php }else if($vw_fitness_gym_theme_lay == 'Left'){ ?>
      <div class="service-text">
        <?php if( get_theme_mod( 'vw_fitness_gym_featured_image_hide_show',true) == 1) { ?>
          <div class="box-image">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>
        <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <?php if( get_theme_mod( 'vw_fitness_gym_toggle_postdate',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_author',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_comments',true) == 1 || get_theme_mod( 'vw_fitness_gym_toggle_time',true) == 1) { ?>
          <div class="post-info">
            <?php if(get_theme_mod('vw_fitness_gym_toggle_postdate',true)==1){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_postdate_icon','fas fa-calendar-alt')); ?>"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_fitness_gym_archive_year, $vw_fitness_gym_archive_month, $vw_fitness_gym_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
            <?php } ?>

            <?php if(get_theme_mod('vw_fitness_gym_toggle_author',true)==1){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_author_icon','far fa-user')); ?>"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
            <?php } ?>

            <?php if(get_theme_mod('vw_fitness_gym_toggle_comments',true)==1){ ?>
               <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_comments_icon','fas fa-comments')); ?>"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'vw-fitness-gym'), __('0 Comments', 'vw-fitness-gym'), __('% Comments', 'vw-fitness-gym') ); ?> </span><span><?php echo esc_html(get_theme_mod('vw_fitness_gym_meta_field_separator', '|'));?></span>
            <?php } ?>

            <?php if(get_theme_mod('vw_fitness_gym_toggle_time',true)==1){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_toggle_time_icon','far fa-clock')); ?>"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
            <?php } ?>
            <?php vw_fitness_gym_edit_link(); ?>
            <hr>
          </div>
        <?php } ?>
        <div class="entry-content">
          <p>
            <?php $vw_fitness_gym_theme_lay = get_theme_mod( 'vw_fitness_gym_excerpt_settings','Excerpt');
            if($vw_fitness_gym_theme_lay == 'Content'){ ?>
              <?php the_content(); ?>
            <?php }
            if($vw_fitness_gym_theme_lay == 'Excerpt'){ ?>
              <?php if(get_the_excerpt()) { ?>
                <p><?php $vw_fitness_gym_excerpt = get_the_excerpt(); echo esc_html( vw_fitness_gym_string_limit_words( $vw_fitness_gym_excerpt, esc_attr(get_theme_mod('vw_fitness_gym_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('vw_fitness_gym_excerpt_suffix',''));?></p>
              <?php }?>
            <?php }?>
          </p>
        </div>
        <?php if( get_theme_mod('vw_fitness_gym_button_text','Read More') != ''){ ?>
          <div class="more-btn">
            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_fitness_gym_button_text',__('Read More','vw-fitness-gym')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_fitness_gym_button_text',__('Read More','vw-fitness-gym')));?></span></a>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</article>