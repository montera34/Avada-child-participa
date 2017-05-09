<?php
global $loop;
// common vars
$item_classes = 'space-item col-md-2';
$loop_perma = get_permalink();
$loop_tit = get_the_title();

$types = get_the_terms($post->ID,'type');
if ( $types == false ) { $loop_color = "#5c5c5c";  } else {
	foreach ( $types as $t ) {
		$loop_type = $t->name;
		//$t_perma = get_term_link($term);
		$loop_color = get_term_meta($t->term_id,"_participa_type_color",true);
		if ( $loop_color == '' ) { $loop_color = "#5c5c5c"; }
	}
}
$neighbourhoods = get_the_terms($post->ID,'neighbourhood');
if ( $neighbourhoods == false ) { $loop_neighbourhood_out = "";  } else {
	foreach ( $neighbourhoods as $t ) {
		$neighbourhoods_list[] = $t->name;
		//$t_perma = get_term_link($term);
	}
	$loop_neighbourhood_out = '<div class="space-terms space-neighbourhood">Foros de barrio</div>';
}
$areas = get_the_terms($post->ID,'area');
if ( $areas == false ) { $loop_area_out = "";  } else {
	foreach ( $areas as $t ) {
		$areas_list[] = $t->name;
		//$t_perma = get_term_link($term);
	}
	$loop_area_out = '<div class="space-terms space-areas">'.implode( ', ',$areas_list ).'</div>';
}
?>

<article class="<?php echo $item_classes; ?>">
	<div class="<?php echo $loop; ?>-pre" style="background-color: <?php echo $loop_color; ?>;"><?php echo $loop_type; ?></div>
	<div class="<?php echo $loop; ?>-text" style="background-color: <?php echo $loop_color; ?>;">
		<div class="space-inner">
			<header class="<?php echo $loop; ?>-heading">
				<h2 class="<?php echo $loop; ?>-tit"><?php echo $loop_tit ?></h2>
			</header>
			<?php echo $loop_neighbourhood_out.$loop_area_out; ?>
		</div>
	</div>
</article>

