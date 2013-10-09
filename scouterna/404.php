<?php
/**
 * The template for displaying 404 pages (Not Found).
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

								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<header class="entry-header">
										<h1 class="entry-title"><?php _e( '404 Not Found', 'scout' ); ?></h1>
									</header><!-- .entry-header -->								
									
								</div>
							</div><!-- .content-block -->
						</div><!-- .content-frame -->
					</div><!-- .content-holder -->
				</div><!-- #content -->
				
				<?php get_template_part('sidebar', 'placeholder-ads'); ?>
				
			</div><!-- #two-columns -->
		
	</div><!-- .main-holder -->

<?php get_footer(); ?>

