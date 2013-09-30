<?php
/**
 * The template for displaying Search Results pages.
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

						<?php if ( have_posts() ) : ?>
							
							<header class="page-header">
								<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'scout' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
							</header>
			
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part('content', 'blog-archives'); ?>
							<?php endwhile; ?>

							<?php twentyeleven_content_nav( 'nav-below' ); ?>

						<?php else : ?>

							<article id="post-0" class="post no-results not-found">
								<header class="entry-header">
									<h1 class="entry-title"><?php _e( 'Nothing Found', 'scout' ); ?></h1>
								</header><!-- .entry-header -->
			
								<div class="entry-content">
									<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'scout' ); ?></p>
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