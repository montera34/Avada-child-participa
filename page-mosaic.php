<?php
/**
 * Template Name: Mosaic
 */

get_header();

$args = array(
	'post_type' => 'space',
	'nopaging' => 'true',
	'orderby' => 'title',
	'order' => 'ASC'
);
$items = new WP_Query($args);
if ( $items->have_posts() ) :
	include('spaces-filters.php'); // FILTERS

	echo '<div class="container-fluid">
		<header class="row space-tabs"><h2 class="col-md-2 space-tab space-tab-active">'.__('Permanent','pparticipa').'</h2><div class="col-md-2 space-tab space-tab-inactive">'.__('One-time','pparticipa').'</div></header>
		'.$filters_out.'
		<div class="space row">';
	$count = 0;
	$break = 0;
	$loop = "space";
	while ( $items->have_posts() ) : $items->the_post();
		$count++;$break++;
		get_template_part('loop','spaces');
//		if ( $break !== 1 ) { echo '<div class="clearfix"></div>'; $break = 0; }
		
	endwhile; // End of the loop.
	wp_reset_postdata();
	echo '</div></div>';
endif;

get_footer();
