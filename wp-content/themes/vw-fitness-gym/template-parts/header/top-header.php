<?php
/**
 * The template part for top header
 *
 * @package VW Fitness Gym 
 * @subpackage vw-fitness-gym
 * @since VW Fitness Gym 1.0
 */
?>

<div id="topbar">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3">
        <div class="logo">
          <div class="logo-box">
            <?php if ( has_custom_logo() ) : ?>
              <div class="site-logo"><?php vw_fitness_gym_the_custom_logo(); ?></div>
            <?php endif; ?>
            <div class="logo-inner">
              <?php $blog_info = get_bloginfo( 'name' ); ?>
                <?php if ( ! empty( $blog_info ) ) : ?>
                  <?php if ( is_front_page() && is_home() ) : ?>
                    <?php if( get_theme_mod('vw_fitness_gym_logo_title_hide_show',true) == 1){ ?>
                      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php } ?>
                  <?php else : ?>
                    <?php if( get_theme_mod('vw_fitness_gym_logo_title_hide_show',true) == 1){ ?>
                      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php } ?>
                  <?php endif; ?>
                <?php endif; ?>
                <?php
                  $description = get_bloginfo( 'description', 'display' );
                  if ( $description || is_customize_preview() ) :
                ?>
                <?php if( get_theme_mod('vw_fitness_gym_tagline_hide_show',false) == 1){ ?>
                  <p class="site-description">
                    <?php echo esc_html($description); ?>
                  </p>
                <?php } ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3">
        <?php if( get_theme_mod( 'vw_fitness_gym_phone_number') != '' ) { ?>
          <span class="call-info"><i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_phone_no_icon','fas fa-phone')); ?>"></i><a href="tel:<?php echo esc_attr( get_theme_mod('vw_fitness_gym_phone_number','') ); ?>"><?php echo esc_html(get_theme_mod('vw_fitness_gym_phone_number',''));?></a></span>
        <?php }?>
      </div>
      <div class="col-lg-3 col-md-3">
        <?php if( get_theme_mod( 'vw_fitness_gym_email_address') != '' ) { ?>
          <span><i class="<?php echo esc_attr(get_theme_mod('vw_fitness_gym_email_icon','fas fa-envelope-open')); ?>"></i><a href="mailto:<?php echo esc_attr(get_theme_mod('vw_fitness_gym_email_address',''));?>"><?php echo esc_html(get_theme_mod('vw_fitness_gym_email_address',''));?></a></span>
        <?php }?>
      </div>
      <div class="col-lg-3 col-md-3">
       <?php dynamic_sidebar('social-widgets'); ?>
      </div>
    </div>
  </div>
</div>