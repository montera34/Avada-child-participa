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
}

// common vars
$loop_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$loop_featured = "<a href=" .$loop_perma. ">" .get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')). "</a>";
} else { $loop_featured = ""; }
$loop_desc = pparticipa_custom_excerpt($excerpt_words);
$loop_tit = get_the_title();
$loop_date = get_the_time('d\/m\/Y');
?>

	<article class="<?php echo $item_classes; ?>">
	<figure class="<?php echo $loop; ?>-img">
		<?php echo $loop_featured ?>
	</figure>
	<div class="<?php echo $loop; ?>-text">
		<header class="<?php echo $loop; ?>-heading">
			<a href="<?php echo $loop_perma ?>"><h2 class="<?php echo $loop; ?>-tit"><?php echo $loop_tit ?></h2></a>
		</header>
		<div class="<?php echo $loop; ?>-desc">
			<span class="<?php echo $loop; ?>-date"><?php echo $loop_date ?></span> <?php echo $loop_desc; ?>
		</div>
	</div>
	
</article>

