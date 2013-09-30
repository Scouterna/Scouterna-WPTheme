<?php
/**
 * Template Name: Full bredd, ingen sidebar
 */
get_header();
?>

    <div class="full-main-holder">
        <div id="content" role="main">
            <div class="content-holder">
                <div class="content-frame">
                    <div class="content-block">
                        <?php while(have_posts()) : the_post(); ?>
                            <?php get_template_part( 'content', 'page' ); ?>
                            <?php comments_template( '', true ); ?>
                        <?php endwhile; ?>
                    </div><!-- .content-block -->
           		</div><!-- .content-frame -->
        	</div><!-- .content-holder -->
    	</div><!-- #content -->
	</div><!-- .full-main-holder -->
<?php get_footer(); ?>
