<?php
/**
 * Services section
 *
 * This is the template for the content of service section
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */
if ( ! function_exists( 'biographyn_add_services_section' ) ) :
    /**
    * Add service section
    *
    *@since  Biographyn 1.0.0
    */
    function biographyn_add_services_section() {
    	$options = biographyn_get_theme_options();
        // Check if service is enabled on frontpage
        $services_enable = apply_filters( 'biographyn_section_status', true, 'services_section_enable' );

        if ( true !== $services_enable ) {
            return false;
        }
        // Get service section details
        $section_details = array();
        $section_details = apply_filters( 'biographyn_filter_services_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        biographyn_render_services_section( $section_details );
    }
endif;

if ( ! function_exists( 'biographyn_get_services_section_details' ) ) :
    /**
    * service section details.
    *
    * @since  Biographyn 1.0.0
    * @param array $input service section details.
    */
    function biographyn_get_services_section_details( $input ) {
        $options = biographyn_get_theme_options();

        // Content type.
        $services_posts_count = ! empty( $options['services_posts_count'] ) ? $options['services_posts_count'] : 3;
        
        $content = array();
        
        $page_ids = array();

        for ( $i = 1; $i <= $services_posts_count; $i++ ) {
            if ( ! empty( $options['services_content_page_' . $i] ) )
                $page_ids[] = $options['services_content_page_' . $i];
        }

        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint( $services_posts_count ),
            'orderby'           => 'post__in',
        );                    
           
        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['content']   = biographyn_trim_content($options['services_excerpt_length']);
                $page_post['url']       = get_the_permalink();

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// service section content details.
add_filter( 'biographyn_filter_services_section_details', 'biographyn_get_services_section_details' );


if ( ! function_exists( 'biographyn_render_services_section' ) ) :
  /**
   * Start service section
   *
   * @return string service content
   * @since  Biographyn 1.0.0
   *
   */
   function biographyn_render_services_section( $content_details = array() ) {
        $options    = biographyn_get_theme_options();
        $image   = !empty( $options['services_image'] ) ? $options['services_image'] : get_template_directory_uri().'/assets/uploads/no-featured-image-600x450.jpg';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        
        <div id="biographyn_our_services" class="relative page-section">
            <div class="wrapper">
                <div class="section-header-wrapper clear">
                    <div class="section-header">
                        <p class="section-subtitle"><?php echo esc_html($options['services_subtitle']); ?></p>
                        <h2 class="section-title"><?php echo esc_html($options['services_title']); ?></h2>
                    </div><!-- .section-header -->

                        <div class="featured-image" style="background-image: url('<?php echo esc_url($image); ?>');"></div>
                </div>

                <div class="section-content col-3 clear">
                <?php foreach($content_details as $i=>$content) :?>

                    <article>
                        <div class="service-item-wrapper">
                            <header class="entry-header">
                                <span><?php echo sprintf("%02d", (absint( $i+1 ))); ?></span>
                                <h2 class="entry-title"><a href="<?php echo esc_url($content['url']); ?>"><?php echo esc_html($content['title']); ?></a></h2>
                            </header>

                            <div class="entry-content">
                                <p><?php echo wp_kses_post($content['content']); ?></p>
                            </div><!-- .entry-content -->
                        </div><!-- service-item-wrapper -->
                    </article>
                    <?php endforeach; ?>

                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #our-services -->
            
    <?php
    }    
endif; 