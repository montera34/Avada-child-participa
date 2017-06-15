<?php
// items list loop
global $loop;
if ( $loop == 'list' ) {
	$img_size = 'micro';
	$excerpt_words = 20;
	$item_classes = 'list-item col-md-6';
} elseif ( $loop == 'mosaic' ) {
	$img_size = 'small';
	$excerpt_words = 30;
	$item_classes = 'mosaic-item col-md-6';
} elseif ( $loop == 'featured' ) {
	$img_size = 'medium';
	$excerpt_words = 60;
	$item_classes = 'featured-item col-md-12';
} elseif ( $loop == 'home-3' ) {
	$img_size = 'small';
	$excerpt_words = 15;
	$item_classes = 'home-item col-md-4';
} elseif ( $loop == 'home-4' ) {
	$img_size = 'small';
	$excerpt_words = 15;
	$item_classes = 'home-item col-md-3';
} elseif ( $loop == 'home-2' ) {
	$img_size = 'small';
	$excerpt_words = 15;
	$item_classes = 'home-item col-md-6';
}


// common vars
$loop_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$loop_featured = "<a href=" .$loop_perma. ">" .get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')). "</a>";
} else { $loop_featured = ""; }

$loop_desc = pparticipa_custom_excerpt($excerpt_words);
if ( $loop_desc != '' )
	$loop_desc = '<div class="'.$loop.'-desc">'.$loop_desc.'</div>';
$loop_tit = get_the_title();

// EVENT VARS
// time vars
// get from the-events/calendar/src/views/modulues/meta/details.php
$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$time_formatted = null;
if ( $start_time == $end_time ) {
	$time_formatted = esc_html( $start_time );
} else {
	$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) { // All day (multiday) events
	$loop_date = $start_date .' <i class="fa fa-chevron-right"></i> '. $end_date;

} elseif ( tribe_event_is_all_day() ) { // All day (single day) events
	$loop_date = $start_date;

} elseif ( tribe_event_is_multiday() ) { // Multiday events
	$loop_date = $start_datetime .' <i class="fa fa-chevron-right"></i> '. $end_datetime;

} else { // single day events
	$loop_date = $start_datetime .' <i class="fa fa-chevron-right"></i> '. $end_time;

}
// place, venue vars
// get from the-events/calendar/src/views/modulues/meta/organizer.php
$loop_place = '';
if ( tribe_get_venue_id() && tribe_address_exists() ) {
	$loop_place = '<div class="event-meta '.$loop.'-place"><i class="fa fa-map-marker"></i> '.tribe_get_full_address().'</div>';
}
// organizer vars
// get from the-events/calendar/src/views/modulues/meta/organizer.php
$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;
foreach ( $organizer_ids as $organizer ) {
	$loop_organizer = "";
	if ( $organizer != '' )
		$loop_organizer = '<div class="event-meta '.$loop.'-organizer"><i class="fa fa-user-circle-o"></i> <span class="tribe-organizer">'.__( 'Organizer','pparticipa' ).': '.tribe_get_organizer_link( $organizer ).'</span></div>';
}
?>

<article class="<?php echo $item_classes; ?>">
	<figure class="<?php echo $loop; ?>-img">
		<?php echo $loop_featured ?>
	</figure>
	<div class="<?php echo $loop; ?>-text">
		<header class="<?php echo $loop; ?>-heading">
			<a href="<?php echo $loop_perma ?>"><h2 class="<?php echo $loop; ?>-tit"><?php echo $loop_tit ?></h2></a>
		</header>
		<div class="<?php echo $loop; ?>-meta">
			<div class="event-meta <?php echo $loop; ?>-date"><i class="fa fa-calendar"></i> <span class="tribe-date"><?php echo $loop_date ?></span></div>
			<?php echo $loop_place ?>
			<?php echo $loop_organizer ?>
		</div>
		<?php echo $loop_desc ?>
	</div>
	
</article>

