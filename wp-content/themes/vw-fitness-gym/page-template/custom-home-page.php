<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_fitness_gym_before_slider' ); ?>

  <?php if( get_theme_mod( 'vw_fitness_gym_slider_hide_show', false) == 1 || get_theme_mod( 'vw_fitness_gym_resp_slider_hide_show', true) == 1) { ?>
    <section id="slider">
      <?php if(get_theme_mod('vw_fitness_gym_slider_type', 'Default slider') == 'Default slider' ){ ?>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr(get_theme_mod( 'vw_fitness_gym_slider_speed',4000)) ?>">
          <?php $vw_fitness_gym_slider_pages = array();
            for ( $count = 1; $count <= 3; $count++ ) {
              $mod = intval( get_theme_mod( 'vw_fitness_gym_slider_page' . $count ));
              if ( 'page-none-selected' != $mod ) {
                $vw_fitness_gym_slider_pages[] = $mod;
              }
            }
            if( !empty($vw_fitness_gym_slider_pages) ) :
              $args = array(
                'post_type' => 'page',
                'post__in' => $vw_fitness_gym_slider_pages,
                'orderby' => 'post__in'
              );
              $query = new WP_Query( $args );
              if ( $query->have_posts() ) :
                $i = 1;
          ?>     
          <div class="carousel-inner" role="listbox">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
              <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
                <?php if(has_post_thumbnail()){
                  the_post_thumbnail();
                } else{?>
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/block-patterns/images/banner.png" alt="" />
                <?php } ?>
                <div class="carousel-caption">
                  <div class="inner_carousel">
                    <h1 class="wow slideInRight" data-wow-duration="2s"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    <p class="wow slideInLeft" data-wow-duration="2s"><?php $vw_fitness_gym_excerpt = get_the_excerpt(); echo esc_html( vw_fitness_gym_string_limit_words( $vw_fitness_gym_excerpt, esc_attr(get_theme_mod('vw_fitness_gym_slider_excerpt_number','30')))); ?></p>
                    <?php if( get_theme_mod('vw_fitness_gym_slider_button_text','READ MORE') != ''){ ?>
                      <div class="more-btn wow slideInRight" data-wow-duration="3s">
                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_fitness_gym_slider_button_text',__('READ MORE','vw-fitness-gym')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_fitness_gym_slider_button_text',__('READ MORE','vw-fitness-gym')));?></span></a>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php $i++; endwhile; 
            wp_reset_postdata();?>
          </div>
          <?php else : ?>
              <div class="no-postfound"></div>
          <?php endif;
          endif;?>
          <?php if(get_theme_mod('vw_fitness_gym_slider_arrow_hide_show', true)){?>
            <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
              <span class="carousel-control-prev-icon w-auto h-auto" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_slider_prev_icon','fas fa-chevron-left')); ?>"></i></span>
              <span class="screen-reader-text"><?php esc_html_e( 'Previous','vw-fitness-gym' );?></span>
            </a>
            <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
              <span class="carousel-control-next-icon w-auto h-auto" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_slider_next_icon','fas fa-chevron-right')); ?>"></i></span>
              <span class="screen-reader-text"><?php esc_html_e( 'Next','vw-fitness-gym' );?></span>
            </a>
          <?php }?>
        </div>
        <div class="clearfix"></div>
      <?php } else if(get_theme_mod('vw_fitness_gym_slider_type', 'Advance slider') == 'Advance slider'){?>
        <?php echo do_shortcode(get_theme_mod('vw_fitness_gym_advance_slider_shortcode')); ?>
      <?php } ?>
    </section>
  <?php } ?>

  <?php do_action( 'vw_fitness_gym_after_slider' ); ?>

  <section id="about-us">
    <div class="container">
      <?php if( get_theme_mod( 'vw_fitness_gym_section_title') != '' ) { ?>
        <h2 class="wow fadeInDown delay-1000 about-us-small-heading"><?php echo esc_html(get_theme_mod('vw_fitness_gym_section_title',''));?></h2>
      <?php }?>
      <?php if( get_theme_mod( 'vw_fitness_gym_sectio_sub_title') != '' ) { ?>
        <h3 class="wow fadeInDown delay-1000"><?php echo esc_html(get_theme_mod('vw_fitness_gym_sectio_sub_title',''));?></h3>
      <?php }?>
      <div class="row">
        <?php if( get_theme_mod( 'vw_fitness_gym_about_image') != '' ) { ?>
        <div class="col-lg-4 col-md-4">        
            <img src="<?php echo esc_url(get_theme_mod('vw_fitness_gym_about_image','')); ?>" alt="About Image"/>
        </div>
        <?php }?>
        <div class="<?php if( get_theme_mod( 'vw_fitness_gym_about_image') != '') { ?>col-lg-8 col-md-8"<?php } else { ?>col-lg-12 col-md-12 <?php } ?> ">
          <div class="row">
            <?php
              $vw_fitness_gym_catData =  get_theme_mod('vw_fitness_gym_services','');
              if($vw_fitness_gym_catData){
              $page_query = new WP_Query(array( 'category_name' => esc_html($vw_fitness_gym_catData,'vw-fitness-gym'))); ?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
              <div class="<?php if( get_theme_mod( 'vw_fitness_gym_about_image') != '') { ?>col-lg-6 col-md-6"<?php } else { ?>col-lg-4 col-md-4 <?php } ?> ">
                <div class="serv-box wow fadeInUp delay-1000">
                  <?php the_post_thumbnail(); ?>

                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h4>
                  <p><?php $vw_fitness_gym_excerpt = get_the_excerpt(); echo esc_html( vw_fitness_gym_string_limit_words( $vw_fitness_gym_excerpt, esc_attr(get_theme_mod('vw_fitness_gym_services_excerpt_number','30')))); ?></p>
                </div>
              </div>
              <?php endwhile;
              wp_reset_postdata();
            } ?>
          </div>
        </div>
      </div>
    </div>  
  </section>

  <?php do_action( 'vw_fitness_gym_after_second_section' ); ?>

  <div class="content-vw entry-content">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
