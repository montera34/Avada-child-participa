<?php
	$filters_out = '';
	$filters = array(
		'type' => array(
			'name' => __('Types','pparticipa'),
			'cols' => '2'
		),
		'area' => array(
			'name' => __('Areas','pparticipa'),
			'cols' => '6'
		),
		'neighbourhood' => array(
			'name' => __('Neighbourhood','pparticipa'),
			'cols' => '4'
		)
	);
	foreach ( $filters as $f => $d ) {
		$args = array(
			'taxonomy' => $f
		);
		$termes = get_terms($args); print_r($terms);
		if ( !is_wp_error($termes) ) {
			$terms_out = '<div class="col-md-'.$d['cols'].'"><div class="space-filter-tit">'.$d['name'].'</div><ul class="space-filter space-filter-'.$f.' list-inline"><li><a data-filter="*" href="#">'.__('All','pparticipa').'</a></li>';
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

?>
