<?php

/**
 * Enqueue scripts and styles.
 */
function pparticipa_scripts() {

	if ( is_page_template('page-fullpage.php') ) wp_enqueue_style( 'fullpage-css', get_stylesheet_directory_uri().'/fullpagejs/jquery.fullPage.css',null,'2.8.6' );
	if ( is_page_template('page-fullpage.php') ) {
wp_enqueue_script( 'fullpage-js', get_stylesheet_directory_uri() . '/fullpagejs/jquery.fullPage.min.js', array('jquery'), '2.8.6', true );
wp_enqueue_script( 'page-fullpage-js', get_stylesheet_directory_uri() . '/js/page-fullpage.js', array('fullpage-js'), '0.1', true );
}

}
add_action( 'wp_enqueue_scripts', 'pparticipa_scripts' );
?>
