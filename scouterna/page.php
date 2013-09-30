<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div class="main-holder">
			<div id="twocolumns">
				<div id="content" role="main">
					<div class="content-holder">
						<div class="content-frame">
							<div class="content-block">

								<?php while ( have_posts() ) : the_post(); ?>

									<?php get_template_part( 'content', 'page' ); ?>
									
									<?php comments_template( '', true ); ?>

								<?php endwhile; // end of the loop. ?>
							</div><!-- .content-block -->
						</div><!-- .content-frame -->
					</div><!-- .content-holder -->
				</div><!-- #content -->
				
				<?php get_template_part('sidebar', 'placeholder-ads'); ?>
				
			</div><!-- #two-columns -->
		
	</div><!-- .main-holder -->

<?php get_footer(); ?>
