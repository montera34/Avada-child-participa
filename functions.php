<?php
// theme setup main function
add_action( 'after_setup_theme', 'pparticipa_theme_setup' );
function pparticipa_theme_setup() {

	/* Set up media options: sizes, featured images... */
	add_filter( 'image_size_names_choose', 'pparticipa_custom_sizes' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 0 ); // default Post Thumbnail dimensions

	// add extra sizes
	add_image_size( 'micro', '166', '0', false );
	add_image_size( 'mini', '362', '0', false );
	add_image_size( 'small', '558', '0', false );

	/* set up image sizes*/
	update_option('thumbnail_size_w', 1200);
	update_option('thumbnail_size_h', 0);
	update_option('thumbnail_crop', 0);
	update_option('medium_size_w', 960);
	update_option('medium_size_h', 0);
	update_option('large_size_w', 1200);
	update_option('large_size_h', 0);

}

function pparticipa_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'micro' => __('Micro','pparticipa'),
        'mini' => __('Mini','pparticipa'),
        'small' => __('Small','pparticipa'),
    ) );
}

/**
 * Enqueue scripts and styles.
 */
function pparticipa_scripts() {

	if ( is_page_template('page-fullpage.php') ) wp_enqueue_style( 'fullpage-css', get_stylesheet_directory_uri().'/fullpagejs/jquery.fullPage.css',null,'2.8.6' );
	if ( is_page_template('page-fullpage.php') ) {
		wp_enqueue_script( 'fullpage-js', get_stylesheet_directory_uri() . '/fullpagejs/jquery.fullPage.min.js', array('jquery'), '2.8.6', true );
		wp_enqueue_script( 'page-fullpage-js', get_stylesheet_directory_uri() . '/js/page-fullpage.js', array('fullpage-js'), '0.1', true );
	}
	if ( is_page_template('page-mosaic.php') || is_page_template('page-home.php') ) {
		wp_enqueue_script( 'isotope-js', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '3.0.4', true );
		wp_enqueue_script( 'page-mosaic-js', get_stylesheet_directory_uri() . '/js/page-mosaic.js', array('isotope-js'), '0.1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'pparticipa_scripts' );

function pparticipa_custom_excerpt($limit) {
	return wp_trim_words(get_the_excerpt(), $limit);
}
?>
