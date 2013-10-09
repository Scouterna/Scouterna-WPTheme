<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

if (!defined('ABSPATH')) die("don't load this page directly");

get_header(); ?>

<div class="main-holder">
	<div id="twocolumns">
		<div id="content" role="main">
			<div class="content-holder">
				<div class="content-frame">
					<div class="content-block">

						<?php if ( have_posts() ) : ?>
			
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php
										get_template_part('content', 'blog-archives');
									
								?>

							<?php endwhile; ?>

							<?php twentyeleven_content_nav( 'nav-below' ); ?>

						<?php else : ?>

							<article id="post-0" class="post no-results not-found">
								<header class="entry-header">
									<h1 class="entry-title"><?php _e( 'Nothing Found', 'scout' ); ?></h1>
								</header><!-- .entry-header -->

								<div class="entry-content">
									<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'scout' ); ?></p>
									<?php get_search_form(); ?>
								</div><!-- .entry-content -->
							</article><!-- #post-0 -->
			
						<?php endif; ?>
					</div><!-- .content-block -->
				</div><!-- .content-frame -->
			</div><!-- .content-holder -->
		</div><!-- #content -->

		<?php get_template_part('sidebar', 'placeholder-ads'); ?>

	</div><!-- #twocolumns -->

</div><!-- .main-holder -->
<?php get_footer(); ?>