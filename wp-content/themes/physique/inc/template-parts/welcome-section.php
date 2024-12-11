<?php
/**
 * The Second Section for our theme.
 *
 * Display all information related to Second section
 *
 * @package Physique
*/

$physiq_wel = get_theme_mod('physiq_hide_wel', '1');

if($physiq_wel  == '') {
    if(get_theme_mod('physiq_wel_sec',true) != '' ) {

        $physiq_welbtn = get_theme_mod('physiq_wel_more');
        if( !empty( $physiq_welbtn ) ){
          $shwwelmore .= '<a href="'.get_the_permalink().'" class="read-more">'.esc_html($physiq_welbtn).'</a>';
        }

        echo '<section class="welcome-section"><div class="wrapper"><div class="flexbox">';
        if(get_theme_mod('physiq_wel_sec') != '') {
            $wel_query = new WP_Query(array('page_id' => get_theme_mod('physiq_wel_sec')));

            while( $wel_query->have_posts() ) : $wel_query->the_post();
                echo '<div class="box">';
                    if( has_post_thumbnail() ) {
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
                        $url = $src[0];
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                      echo '<div class="thumb"><img src="'.esc_url($url).'" alt="'.esc_attr($image_alt).'"></div><!-- thumb -->';
                    }
                echo '</div><div class="box"><div class="welcome-content"><div class="section_head"><h2 class="section_title">'.get_the_title().'</h2></div><p>'.get_the_content().'</p>'.$shwwelmore.'</div></div>';
            endwhile;
        }
        echo '</div></div></section>';
    }
}