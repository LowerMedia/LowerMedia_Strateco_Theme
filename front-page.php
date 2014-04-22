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
			<img src="http://stratecollc.com/wp-content/blog.dir/sites/34/2014/02/strateco_llc_logo_mobile_alabama_marketing_800_white.png" />
		</div>
	</header><!-- #masthead -->

	<div id="content-out-wrap" class="content-out-wrap">
		<?php
			get_template_part( 'navigation' );
		?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
	            	global $lm_options;
					$lm_settings = get_option( 'lm_options', $lm_options );
				?>
	            
	            <section id="intro-wrap" class="intro-wrap front-page-section">

					<?php if( $lm_settings['intro_title'] != '' ) { ?>
						<h1 class="entry-title"><?php echo $lm_settings['intro_title'] ?></h1>
					<?php } else {?>
						<h1 class="entry-title"><a href="/">A Strategy Company</a></h1>
					<?php } ?>

	                <?php if( $lm_settings['intro_text'] != '' ) : ?>
					
	                <div class="intro inner-section-wrap">
						<p>
							<?php echo $lm_settings['intro_text']; ?>
						</p>
	                </div>

	                <?php endif; ?>
	            </section>
				

				<section id="paralax-slider-wrap" class="paralax-slider-wrap front-page-section">
					
					<div class='inner-section-wrap'>
					<?php 
						$lm_settings = get_option( 'lm_options', $lm_options ); 
					 	echo do_shortcode( str_replace('\"', '"', $lm_settings['services_shortcode']));
					?>
					</div>
				</section>
				
				<section id="team-wrap" class="team-wrap front-page-section">
					<div class='inner-section-wrap'>
					<h2>Strateco Team</h2>
					<?php

						$args = array( 'post_type' => 'staff_members', 'posts_per_page' => 4 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$permalink = get_permalink( get_the_ID());
							echo '<div class="entry-wrap"><div class="entry-thumb">';
							the_post_thumbnail();
							echo '</div><div class="entry-title"><h3><a href="'.$permalink.'">';
							the_title();
							echo '</a></h3></div><div class="entry-content">';
							echo get_post_meta(get_the_ID(), 'staff_members', true);
							echo '</div></div>';
						endwhile;
					?>
				</div>
				</section>
				
				<section id="contact-wrap" class="contact-wrap front-page-section">
					<div class='inner-section-wrap'>
						<?php 
							$lm_settings = get_option( 'lm_options', $lm_options ); 
					 		echo do_shortcode( str_replace('\"', '"', $lm_settings['contact_form_shortcode']));
						?>
					</div>
				</section>


			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content-out-wrap -->

<?php get_footer();
