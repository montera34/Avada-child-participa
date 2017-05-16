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
		<header class="col-md-6"><h2 class="home-block-tit">Actualidad</h2></header>
		<div class="clearfix"></div>
	';
	$count = 0;
	$break = 0;
	while ( $news->have_posts() ) : $news->the_post();
		$count++;$break++;
		$loop = "home";

		get_template_part('loop','list');
		

	endwhile; // End of the loop.
	wp_reset_postdata();
	echo '</div></div>
		<div class="col-md-12 home-block-plus">
			<a href="/actualidad"><i class="fa fa-plus"></i> actualidad</a>
		</div></div></div>';
endif;


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
	// FILTERS
	$filters_out = '';
	$filters = array(
		'type' => array(
			'name' => 'Tipos',
			'cols' => '2'
		),
		'area' => array(
			'name' => 'Áreas',
			'cols' => '6'
		),
		'neighbourhood' => array(
			'name' => 'Barrios',
			'cols' => '4'
		)
	);
	foreach ( $filters as $f => $d ) {
		$args = array(
			'taxonomy' => $f
		);
		$termes = get_terms($args); print_r($terms);
		if ( !is_wp_error($termes) ) {
			$terms_out = '<div class="col-md-'.$d['cols'].'"><div class="space-filter-tit">'.$d['name'].'</div><ul class="space-filter space-filter-'.$f.' list-inline"><li><a data-filter="*" href="#">Todos</a></li>';
			foreach ( $termes as $t ) {
				if ( $f == 'type') {
					$term_color = get_term_meta($t->term_id,"_participa_type_color",true);
					$term_style = ' style="background-color: '.$term_color.'"';
				} else { $term_style = ''; }
				$terms_out .= '<li><a '.$term_style.' data-filter=".'.$t->slug.'" href="#">'.$t->name.'</a></li>';
				
			}
			$terms_out .= '</ul></div>';
			$filters_out .= $terms_out;
		}
	}
	if ( $filters_out != '' ) $filters_out = '<div class="row space-filters">'.$filters_out.'</div>';
	// end FILTERS
	echo '<div id="spaces" class="home-block container-fluid">
		<header class="row space-tabs"><h2 class="col-md-2 space-tab space-tab-active">Espacios estables de participación</h2><div class="col-md-2 space-tab space-tab-inactive pparticipa-tooltip">Espacio puntuales de participación</div></header>
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
