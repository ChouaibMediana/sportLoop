<?php
/**
 * VW Fitness Gym: Block Patterns
 *
 * @package VW Fitness Gym
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'vw-fitness-gym',
		array( 'label' => __( 'VW Fitness Gym', 'vw-fitness-gym' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'vw-fitness-gym/banner-section',
		array(
			'title'      => __( 'Banner Section', 'vw-fitness-gym' ),
			'categories' => array( 'vw-fitness-gym' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png\",\"id\":6319,\"dimRatio\":0,\"align\":\"full\",\"className\":\"banner-section\"} -->\n<div class=\"wp-block-cover alignfull banner-section\" style=\"background-image:url(" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png)\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"wide\"} -->\n<div class=\"wp-block-columns alignwide\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":1} -->\n<h1 class=\"has-text-align-left\">TE OBTINUIT UT ADEPTO SATIS SOMNO</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\"} -->\n<p class=\"has-text-align-left\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard.&nbsp;</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons {\"align\":\"left\"} -->\n<div class=\"wp-block-buttons alignleft\"><!-- wp:button {\"style\":{\"color\":{\"background\":\"#fb6935\"}}} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background\" style=\"background-color:#fb6935\">READ MORE</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'vw-fitness-gym/services-section',
		array(
			'title'      => __( 'Services Section', 'vw-fitness-gym' ),
			'categories' => array( 'vw-fitness-gym' ),
			'content'    => "<!-- wp:cover {\"customOverlayColor\":\"#24272e\",\"align\":\"full\",\"className\":\"article-outer-box\"} -->\n<div class=\"wp-block-cover alignfull has-background-dim article-outer-box\" style=\"background-color:#24272e\"><div class=\"wp-block-cover__inner-container\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"text\":\"#8d939f\"}}} -->\n<h2 class=\"has-text-align-center has-text-color\" style=\"color:#8d939f\">FITNESS ABOUT US</h2>\n<!-- /wp:heading -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->\n<h3 class=\"has-text-align-center\">WELCOME TO THE FITNESS</h3>\n<!-- /wp:heading -->\n\n<!-- wp:columns {\"align\":\"wide\",\"className\":\"article-container\"} -->\n<div class=\"wp-block-columns alignwide article-container\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"33.33%\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":6328,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/fitnessaboutusimg.png\" alt=\"\" class=\"wp-image-6328\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"66.66%\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:66.66%\"><!-- wp:group {\"className\":\"services-box\"} -->\n<div class=\"wp-block-group services-box\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":6330,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/aboutusicon1.png\" alt=\"\" class=\"wp-image-6330\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"left\",\"level\":4} -->\n<h4 class=\"has-text-align-left\">FEATURES TITLE 1</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\",\"style\":{\"color\":{\"text\":\"#8d939f\"}}} -->\n<p class=\"has-text-align-left has-text-color\" style=\"color:#8d939f\">Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":6334,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/aboutusicon2.png\" alt=\"\" class=\"wp-image-6334\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"left\",\"level\":4} -->\n<h4 class=\"has-text-align-left\">FEATURES TITLE 2</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\",\"style\":{\"color\":{\"text\":\"#8d939f\"}}} -->\n<p class=\"has-text-align-left has-text-color\" style=\"color:#8d939f\">Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":6335,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/aboutusicon3.png\" alt=\"\" class=\"wp-image-6335\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"left\",\"level\":4} -->\n<h4 class=\"has-text-align-left\">FEATURES TITLE 3</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\",\"style\":{\"color\":{\"text\":\"#8d939f\"}}} -->\n<p class=\"has-text-align-left has-text-color\" style=\"color:#8d939f\">Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":6336,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/aboutusicon4.png\" alt=\"\" class=\"wp-image-6336\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"left\",\"level\":4} -->\n<h4 class=\"has-text-align-left\">FEATURES TITLE 4</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\",\"style\":{\"color\":{\"text\":\"#8d939f\"}}} -->\n<p class=\"has-text-align-left has-text-color\" style=\"color:#8d939f\">Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);
}