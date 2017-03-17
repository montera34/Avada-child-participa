<?php
/**
 * Template Name: Full Screen Background Image Template
 */

get_header('fullpage');

while ( have_posts() ) : the_post(); ?>

	<main id="fullpage" class="site-main" role="main">

			<?php
			$bgi_desc = apply_filters('the_content', get_the_content() );
			$bgi_desc_out = ( $bgi_desc == '' ) ? "" : "<div class='row'><div class='col-md-12 fp-slide-desc'>".$bgi_desc."</div></div>";
			if ( has_post_thumbnail() ) {
				$bgi_id = get_post_thumbnail_id($post->ID);
				//echo $bgi_id;
				$bgi_src = wp_get_attachment_url($bgi_id);
//echo $bgi_src;
				echo "
				<section class='fp-slide' style='background-image:url(".$bgi_src.");'>
				<header class='hide-text'><h1 class='main-title'>". bloginfo( 'name' ). "</h1></header>
					<div class='container vspace'>
						".$bgi_desc_out."
					</div>
				</section>
				";
			}
			?>
	</main><!-- #fullpage -->

<?php
endwhile; // End of the loop.
get_footer('fullpage');
