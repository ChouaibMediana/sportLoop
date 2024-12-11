<?php
/**
 * About section
 *
 * This is the template for the content of about section
 *
 * @package Theme Palace
 * @subpackage Biographyn
 * @since Biographyn 1.0.0
 */
if ( ! function_exists( 'biographyn_add_about_us_section' ) ) :
    /**
    * Add about section
    *
    *@since Biographyn 1.0.0
    */
    function biographyn_add_about_us_section() {
    	$options = biographyn_get_theme_options();
        // Check if about is enabled on frontpage
        $about_us_enable = apply_filters( 'biographyn_section_status', true, 'about_us_section_enable' );

        if ( true !== $about_us_enable ) {
            return false;
        }
        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'biographyn_filter_about_us_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        biographyn_render_about_us_section( $section_details );
    }
endif;

if ( ! function_exists( 'biographyn_get_about_us_section_details' ) ) :
    /**
    * about section details.
    *
    * @since Biographyn 1.0.0
    * @param array $input about section details.
    */
    function biographyn_get_about_us_section_details( $input ) {
        $options = biographyn_get_theme_options();

        // Content type.
        $about_us_content_type  = $options['about_us_content_type'];
        
        $content = array();

        $page_id = ! empty( $options['about_us_content_page'] ) ? $options['about_us_content_page'] : '';

        $args = array(
            'post_type'             => 'page',
            'page_id'               =>  absint( $page_id ),
            'posts_per_page'        => 1,
        );

        if ( 'custom' !== $about_us_content_type ) :
            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = biographyn_trim_content( $options['about_us_excerpt_length'] );
                    $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri().'/assets/uploads/no-featured-image-600x450.jpg';

                    // Push to the main array.
                    array_push( $content, $page_post );
                endwhile;
            endif;
            wp_reset_postdata();
        endif;
            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// about section content details.
add_filter( 'biographyn_filter_about_us_section_details', 'biographyn_get_about_us_section_details' );


if ( ! function_exists( 'biographyn_render_about_us_section' ) ) :
  /**
   * Start about section
   *
   * @return string about content
   * @since Biographyn 1.0.0
   *
   */
   function biographyn_render_about_us_section( $content_details = array() ) {
        $options = biographyn_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>

            <div id="biographyn_about_section" class="page-section">
                <div class="wrapper">
                <?php foreach ( $content_details as $content ) :  ?>

                    <div class="about-wrapper">
                        <div class="section-header">
                            <h2 class="section-title"><?php echo esc_html( $content['title'] ); ?></h2>
                            <p class="section-subtitle"><?php echo esc_html( $options['about_us_sub_title'] ); ?></p>
                        </div>

                        <div class="section-content clear">
                            <?php 
                                $page_ids = ! empty( $options['about_us_content_multitple_page'] ) ? $options['about_us_content_multitple_page'] : array();                                  
                                $content_pages = get_posts(['include' => $page_ids, 'post_type' => 'page']); ?>

                            <div class="hentry">
                                <ol>
                                <?php foreach( $content_pages as $i=>$page ){
                                    echo '<li><a href="'.get_page_link( $page->ID ).'">'.$page->post_title.'</a></li>';
                                } ?>
                                </ol>
                            </div>

                            <div class="hentry">
                                <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');"></div>

                                <div class="entry-content">
                                    <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                </div>

                            </div>

                        </div>
                        <?php if( !empty( $content['url'] ) && !empty( $options['about_us_btn_title'] ) ): ?>
                            <div class="read-more">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $options['about_us_btn_title'] ); ?></a>
                            </div><!-- .read-more -->
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                </div>
            </div>


                  
<?php  }

endif;
