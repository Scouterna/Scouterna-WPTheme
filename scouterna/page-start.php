<?php
/**
 * Template Name: Start Template
 * Description: A Page Template that adds a sidebar to pages
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<!-- promo block -->
		
		<div class="promo">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; // end of the loop. ?>
		</div><!-- .promo -->
		
        <?php if(is_active_sidebar('top-start-sidebar')){ ?>
			<div class="boxes">
				<?php dynamic_sidebar( 'top-start-sidebar' ); ?>
			</div><!-- .boxes -->
		<?php } ?>
        
        <?php if(is_active_sidebar('left-start-sidebar') || is_active_sidebar('two-column-start-sidebar')){ ?>
		<!-- news columns -->
		<div class="columns">
			<div class="columns-holder">
				<div class="columns-frame">
					<div class="columns-block">
						<div class="left-column">
							<?php dynamic_sidebar( 'left-start-sidebar' ); ?>
						</div><!-- .left-column -->
                       	<?php dynamic_sidebar( 'two-column-start-sidebar' ); ?>
                        
					</div><!-- .columns-block -->
				</div><!-- .columns-frame -->
			</div><!-- .columns-holder -->
		</div><!-- .columns -->
        <?php } ?>
		
<?php get_footer(); ?>