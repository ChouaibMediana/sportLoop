<?php
/**
 * Banner section
 *
 * This is the template for the content of connect section
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */
if ( ! function_exists( 'biographyn_add_connect_section' ) ) :
    /**
    * Add connect section
    *
    *@since  Biographyn 1.0.0
    */
    function biographyn_add_connect_section() {
    	$options = biographyn_get_theme_options();
        // Check if connect is enabled on frontpage
        $connect_enable = apply_filters( 'biographyn_section_status', true, 'connect_section_enable' );

        if ( true !== $connect_enable ) {
            return false;
        }

        // Render connect section now.
        biographyn_render_connect_section();
    }
endif;


if ( ! function_exists( 'biographyn_render_connect_section' ) ) :
  /**
   * Start connect section
   *
   * @return string connect content
   * @since  Biographyn 1.0.0
   *
   */
   function biographyn_render_connect_section( ) {
        $options        = biographyn_get_theme_options();
        $image   = empty( $options['connect_image'] ) ? '' : $options['connect_image'] ;  ?>
        

        <div id="biographyn_connect_section" class="page-section">
            <div class="wrapper">
                <div class="section-header-wrapper">
                    <?php if(!empty($image)) 
                        echo '<div class="featured-image"><img src="'.esc_url($image).'"></div>';
                    ?>

                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $options['connect_section_title'] ); ?></h2>
                        <p class="section-subtitle"><?php echo esc_html( $options['connect_section_subtitle'] ); ?></p>
                    </div>
                </div>

                <?php if( !empty($options['connect_btn_txt']) && !empty($options['connect_btn_link'])) : ?>
                    <div class="read-more">
                        <a href="<?php echo esc_url($options['connect_btn_link']); ?>" class="btn"><?php echo esc_html($options['connect_btn_txt']); ?></a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
  
        <?php 
    }    
endif; ?>
