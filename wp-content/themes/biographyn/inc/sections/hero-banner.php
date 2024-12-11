<?php
/**
 * Banner section
 *
 * This is the template for the content of hero hero_banner section
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */
if ( ! function_exists( 'biographyn_add_hero_banner_section' ) ) :
    /**
    * Add hero_banner section
    *
    *@since  Biographyn 1.0.0
    */
    function biographyn_add_hero_banner_section() {
    	$options = biographyn_get_theme_options();
        // Check if hero_banner is enabled on frontpage
        $hero_banner_enable = apply_filters( 'biographyn_section_status', true, 'hero_banner_section_enable' );

        if ( true !== $hero_banner_enable ) {
            return false;
        }
        // Get hero_banner section details
        $section_details = array();
        $section_details = apply_filters( 'biographyn_filter_hero_banner_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render hero_banner section now.
        biographyn_render_hero_banner_section( $section_details );
}

endif;

if ( ! function_exists( 'biographyn_get_hero_banner_section_details' ) ) :
    /**
    * hero_banner section details.
    *
    * @since  Biographyn 1.0.0
    * @param array $input hero_banner section details.
    */
    function biographyn_get_hero_banner_section_details( $input ) {
        $options = biographyn_get_theme_options();

        // Content type.
        $hero_banner_content_type    = $options['hero_banner_content_type'];
        
        $content = array();
        $page_id = ! empty( $options['hero_banner_content_page'] ) ? $options['hero_banner_content_page'] : '';
    
        $args = array(
            'post_type'             => 'page',
            'p'                     =>  absint( $page_id ),
            'ignore_sticky_posts'   => true,
        );                  

    // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['excerpt']   = biographyn_trim_content($options['hero_banner_excerpt_length']);
                $page_post['url']       = get_the_permalink( );
                $page_post['image']     = !empty(get_the_post_thumbnail_url( )) ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';
                // Push to the main array.
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
// hero_banner section content details.
add_filter( 'biographyn_filter_hero_banner_section_details', 'biographyn_get_hero_banner_section_details' );


if ( ! function_exists( 'biographyn_render_hero_banner_section' ) ) :
  /**
   * Start hero_banner section
   *
   * @return string hero_banner content
   * @since  Biographyn 1.0.0
   *
   */
   function biographyn_render_hero_banner_section( $content_details = array() ) {
        $options = biographyn_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        }
        $content = $content_details[0]; ?>
            <div id="biographyn_header_content_section">
                <div class="wrapper">
                    <div class="social-icons">
                        <?php 
                        if(has_nav_menu( 'social' ) && $options['hero_banner_social_menu_enable']) :
                            wp_nav_menu( 
                                array(
                                    'theme_location' => 'social',
                                    'container' => 'ul',
                                    'menu_class' => 'social-icons',
                                    'echo' => true,
                                    'depth' => 1,
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'fallback_cb' => false,
                                )
                            );
                        endif; 
                        ?>
                    </div><!-- .social-icons -->

                    <article>
                        <div class="hentry">
                            <div class="section-header">
                                <h2 class="section-title">
                                    <?php $name = explode(' ', $options['hero_banner_title'], 2); ?>
                                    <span class="first-name"><?php echo esc_html($name[0]); ?></span>
                                    <span class="last-name"><?php echo esc_html($name[1]); ?></span>
                                </h2>

                                <div class="entry-meta">
                                    <span><?php echo esc_html($options['hero_banner_dob']); ?></span>
                                    <p><?php echo esc_html($options['hero_banner_dob_title']); ?></p>
                                </div><!-- .entry-meta --> 
                            </div><!-- .section-header -->

                           
                        </div><!-- .hentry --> 

                        <div class="hentry">
                            <div class="featured-image" style="background-image: url('<?php echo esc_url($content['image']); ?>');"></div>

                            <div class="section-content">
                                <div class="header-content-wrapper">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><?php echo esc_html($content['title']); ?></h2>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                    </div>
                                </div><!-- .header-content-wrapper -->

                                <div class="header-content-wrapper">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><?php echo esc_html( $options['hero_banner_content_title'] ); ?></h2>
                                    </header>
                                    <?php 
                                    $page_ids = ! empty( $options['hero_banner_content_multitple_page'] ) ? $options['hero_banner_content_multitple_page'] : array();                                  
                                    $content_pages = get_posts(['include' => $page_ids, 'post_type' => 'page']); ?>

                                    <div class="entry-content">
                                        <ul>
                                            <li>
                                            <?php foreach( $content_pages as $page ){
                                                echo '<a href="'.get_page_link( $page->ID ).'">'.$page->post_title.'</a>';
                                            } ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .header-content-wrapper -->
                            </div><!-- .section-content --> 
                        </div><!-- .hentry --> 
                   </article>
                    <div class="scroll">
                        <span><?php echo esc_html($options['hero_banner_know_more_txt']); ?>
                            <a href="#"> 
                                <?php echo esc_html($options['hero_banner_btn_txt']); ?>
                                <?php echo biographyn_get_svg( array( 'icon' => 'right-arrow' ) ); ?>
                            </a>
                        </span>
                    </div>
                </div><!-- .wrapper -->
            </div>

<?php
    }    
endif;