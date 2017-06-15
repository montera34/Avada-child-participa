<?php
/**
 * Template Name: Home
 */

get_header();

// NEWS
////

$args = array(
	'post_type' => 'news',
	'posts_per_page' => '3'
);
$news = new WP_Query($args);
if ( $news->have_posts() ) :
	echo '<div id="news" class="home-block container-fluid"><div class="row">
		<div class="col-md-12">
		<div class="news list row">
		<header class="col-md-6"><h2 class="home-block-tit"><i class="fa fa-newspaper-o"></i> '.__('News','pparticipa').'</h2></header>
		<div class="clearfix"></div>
	';
	$count = 0;
	$break = 0;
	while ( $news->have_posts() ) : $news->the_post();
		$count++;$break++;
		$loop = "home-3";

		get_template_part('loop','list');
		

	endwhile; // End of the loop.
	wp_reset_postdata();
	echo '</div></div>
		<div class="col-md-12 home-block-plus">
			<a href="/actualidad"><i class="fa fa-plus"></i> '.__('News','pparticipa').'</a>
		</div></div></div>';
endif;

// EVENTS
////

$args = array(
	'post_type' => 'tribe_events',
);
$events = new WP_Query($args);
if ( $events->have_posts() ) :
	echo '<div id="news" class="home-block container-fluid"><div class="row">
		<div class="col-md-12">
		<div class="news list row">
		<header class="col-md-6"><h2 class="home-block-tit"><i class="fa fa-calendar-o"></i> '.__('Coming events','pparticipa').'</h2></header>
		<div class="clearfix"></div>
	';
	$count = 0;
	$break = 0;
	while ( $events->have_posts() ) : $events->the_post();
		$count++;$break++;
		$loop = "home-4";

		get_template_part('loop','event');

		if ( $count == 4 ) {
			echo '<div class="clearfix"></div>';
			$count = 0;
		}

	endwhile; // End of the loop.
	wp_reset_postdata();
	echo '</div></div>
		<div class="col-md-12 home-block-plus">
			<a href="/agenda">'.__('View events calendar','pparticipa').'</a>
		</div></div></div>';
endif;

// WIDGET BAR
////
if ( is_active_sidebar( 'home-widgets' ) ) 
	dynamic_sidebar( 'home-widgets' );

// SPACES
//// 

$args = array(
	'post_type' => 'space',
	'nopaging' => 'true',
	'orderby' => 'title',
	'order' => 'ASC'
);
$items = new WP_Query($args);
if ( $items->have_posts() ) :
	include('spaces-filters.php'); // FILTERS

	echo '<div id="spaces" class="home-block container-fluid">
		<header class="row space-tabs"><h2 class="col-md-2 space-tab space-tab-active"><i class="fa fa-map-marker"></i> '.__('Permanent participation spaces','pparticipa').'</h2><div class="col-md-2 space-tab space-tab-inactive pparticipa-tooltip">'.__('One-time participation spaces','pparticipa').'</div></header>
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
