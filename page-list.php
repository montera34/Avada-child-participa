<?php
/**
 * Template Name: List
 */

get_header();

$args = array(
	'post_type' => 'news'
);
$news = new WP_Query($args);
//if ( have_posts() ) :
if ( $news->have_posts() ) :
	echo '<div class="container-fluid"><div class="row">
		<div class="col-md-10 col-md-offset-1">
		<div class="list row">';
	$count = 0;
	$break = 0;
	while ( $news->have_posts() ) : $news->the_post();
		$count++;$break++;
		if ( $count == 1 ) { $loop = "featured"; $break = 0; }
		elseif ( $count > 1 && $count < 8 ) { $loop = "mosaic"; }
		else { $loop = "list"; }

		get_template_part('loop','list');
		if ( $break !== 1 ) { echo '<div class="clearfix"></div>'; $break = 0; }
		

	endwhile; // End of the loop.
	wp_reset_postdata();
	echo '</div></div></div></div>';
endif;

get_footer();
