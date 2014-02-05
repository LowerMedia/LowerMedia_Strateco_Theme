<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Bushwick
 */
get_header(); ?>



	<header id="one-page-masthead" class="one-page-site-header" role="banner" style="background-image:url(<?php header_image(); ?>);">
		<div class="site-branding">
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
	</header><!-- #masthead -->

	<?php
		get_template_part( 'navigation' );
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<h1 class="entry-title"><a href="">A Strategy Company</a></h1>

			<section id="paralax-slider-wrap" class="paralax-slider-wrap front-page-section">

			</section>
			
			<section id="team-wrap" class="team-wrap front-page-section">

				<h2>Strateco Team</h2>
				<?php

					$args = array( 'post_type' => 'staff_members', 'posts_per_page' => 4 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						$permalink = get_permalink( get_the_ID());
						echo '<div class="entry-wrap">';
						echo '<div class="entry-thumb">';
						the_post_thumbnail();
						echo '</div>';
						echo '<div class="entry-title"><h3>';
						echo '<a href="'.$permalink.'">';
						the_title();
						echo '</a></h3></div>';
						echo '<div class="entry-content">';
						the_content();
						echo '</div></div>';
					endwhile;
				?>

			</section>
			
			<section id="contact-wrap" class="contact-wrap front-page-section">

			</section>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
