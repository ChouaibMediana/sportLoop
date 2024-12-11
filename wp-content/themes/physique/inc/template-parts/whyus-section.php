<?php
/**
 * The First Section for our theme.
 *
 * Display all information related to first section
 *
 * @package Physique
*/

$dispsec = get_theme_mod( 'physiq_hide_fsec','1' );

if( $dispsec == '' ){
	
    echo '<section class="whyus-section"><div class="wrapper">';

        $whyussecttl = get_theme_mod('physiq_whyus_ttl','1');
        if( !empty( $whyussecttl ) ){
          echo '<div class="section_head"><h2 class="section_title">'.esc_html($whyussecttl).'</h2></div>';
        }
		
        $whyusmore = get_theme_mod('whyus_more');
        if( !empty( $whyusmore ) ){
          $shwwhyusmore .= '<a href="'.get_the_permalink().'" class="whyus-more">'.esc_html($whyusmore).'</a>';
        }

        echo '<div class="flexbox">';
            for( $whyussec = 1; $whyussec<4; $whyussec++ ){
                if( get_theme_mod( 'whyus'.$whyussec,true ) !='' ){
                    $whyusquery = new WP_Query( array( 'page_id' => get_theme_mod( 'whyus'.$whyussec ) ) );
                    while( $whyusquery->have_posts() ) : $whyusquery->the_post();
                        $shwthumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        echo '<div class="box"><div class="whyus-box"><div class="inner-whyus">';
                            if( has_post_thumbnail() ) {
                              echo '<div class="whyus-thumb"><img src="'.esc_url($shwthumb[0]).'" alt="'.esc_attr($image_alt).'"/></div><!-- why us thumb -->';
                            }
                            echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3><p>'.get_the_excerpt().'</p>'.$shwwhyusmore.'';
                        echo '</div></div></div>';
                    endwhile; wp_reset_postdata();
                }
            }
    echo '</div></div></section>';
}