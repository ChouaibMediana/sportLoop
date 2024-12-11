<?php
/**
 * Testimonial section
 *
 * This is the template for the content of Testimonial section
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

if ( ! function_exists( 'biographyn_add_testimonial_section' ) ) :
    /**
    * Add testimonial section
    *
    *@since  Biographyn 1.0.0
    */
    function biographyn_add_testimonial_section() {
    	$options = biographyn_get_theme_options();
        // Check if testimonial is enabled on frontpage
        $testimonial_enable = apply_filters( 'biographyn_section_status', true, 'testimonial_section_enable' );

        if ( true !== $testimonial_enable ) {
            return false;
        }
        // Get testimonial section details
        $section_details = array();
        $section_details = apply_filters( 'biographyn_filter_testimonial_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return ;
        }
        // Render testimonial section now.
        biographyn_render_testimonial_section( $section_details );
    }
endif;

if ( ! function_exists( 'biographyn_get_testimonial_section_details' ) ) :
    /**
    * testimonial section details.
    *
    * @since  Biographyn 1.0.0
    * @param array $input testimonial section details.
    */
    function biographyn_get_testimonial_section_details( $input ) {
        $options = biographyn_get_theme_options();

        // Content type.
        $testimonial_content_type   = $options['testimonial_content_type'];
        $testimonial_count          = isset($options['testimonial_posts_count'] ) ? $options['testimonial_posts_count'] : 3;

        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= $testimonial_count; $i++ ) {
            if ( ! empty( $options['testimonial_content_post_' . $i] ) )
                $post_ids[] = $options['testimonial_content_post_' . $i];
        }

        $args = array(
            'post_type'             => 'post',
            'post__in'              => ( array ) $post_ids,
            'posts_per_page'        => absint( $testimonial_count ),
            'orderby'               => 'post__in',
            'ignore_sticky_posts'   => true,
        );
          
        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
            $i = 1;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']          = get_the_title();
                $page_post['id']             = get_the_id();
                $page_post['excerpt']        = biographyn_trim_content(40);
                $page_post['url']            = get_the_permalink();
                $page_post['image']          = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';
                $page_post['designation']    = isset($options['testimonial_post_designation_'.$i])?$options['testimonial_post_designation_'.$i] : '';
                // Push to the main array.
                array_push( $content, $page_post );
                $i++;
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// testimonial section content details.
add_filter( 'biographyn_filter_testimonial_section_details', 'biographyn_get_testimonial_section_details' );


if ( ! function_exists( 'biographyn_render_testimonial_section' ) ) :
  /**
   * Start testimonial section
   *
   * @return string testimonial content
   * @since  Biographyn 1.0.0
   *
   */
   function biographyn_render_testimonial_section( $content_details = array() ) {
        $options            = biographyn_get_theme_options();
        $image   = empty( $options['testimonial_image'] ) ? '' : $options['testimonial_image'] ;

        if ( empty( $content_details ) ) {
            return;
        } ?>
    
        <div id="biographyn_testimonial_section" class="page-section same-background">
            <div class="wrapper">
                <div class="section-header-wrapper clear">
                    <div class="section-header">
                        <p class="section-subtitle"><?php echo esc_html( $options['testimonial_subtitle'] ); ?></p>
                        <h2 class="section-title"><?php echo esc_html( $options['testimonial_title'] ); ?></h2>
                    </div><!-- .section-header --> 
            

                </div>
                
                
                <div class="testimonial-content">
                    <div class="testimonial-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": false, "speed": 1000, "dots": false, "arrows":false, "autoplay": true, "draggable": true, "fade": false }'>
                    <?php foreach($content_details as $content): ?>
                        <article>
                            <div class="featured-image" style="background-image: url('<?php echo esc_url($image); ?>');"></div>

                            <div class="testimonial-wrapper">
                                    <a href="<?php echo esc_url($content['url']); ?>"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/uploads/quote.png'); ?>" alt="<?php echo esc_attr($content['title']); ?>"></a>
                                <div class="entry-content">
                                    <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                </div>
                                <div class="author-detail">
                                    <div class="image-wrapper">
                                        <a href="<?php echo esc_url($content['url']); ?>"><img src="<?php echo esc_url($content['image']); ?>" alt="<?php echo esc_attr($content['title']); ?>"></a>
                                    </div><!-- .featured-image -->

                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url($content['url']); ?>"><?php echo esc_html($content['title']); ?></a></h2>
                                        <p><?php echo esc_html($content['designation']); ?></p>
                                    </header><!-- .entry-header -->
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    <?php

    }
endif;
