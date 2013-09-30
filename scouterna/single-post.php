<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

if (!defined('ABSPATH')) die("don't load this page directly");

get_header(); ?>
<div class="main-holder">
	<div id="twocolumns">
		<div id="content" role="main">
			<div class="content-holder">
				<div class="content-frame">
					<div class="content-block">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'single' ); ?>

							<?php comments_template( '', true ); ?>
								<nav id="nav-single">
									<h3 class="assistive-text"><?php _e( 'Post navigation', 'scout' ); ?></h3>
									<span class="nav-previous alignleft"><?php previous_post_link('<span class="meta-nav">&laquo;</span> %link', __('Previous', 'scout')); ?></span>
									<span class="nav-next alignright"><?php next_post_link('%link <span class="meta-nav">&raquo;</span>', __('Next', 'scout')); ?></span>
								</nav><!-- #nav-single -->

						<?php endwhile; // end of the loop. ?>
					</div><!-- .content-block -->
				</div><!-- .content-frame -->
			</div><!-- .content-holder -->
		</div><!-- #content -->

		<?php get_template_part('sidebar', 'placeholder-ads'); ?>

	</div><!-- #two-columns -->

</div><!-- .main-holder -->
<?php get_footer(); ?>