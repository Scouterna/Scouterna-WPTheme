<?php
include_once( 'inc/folded-child-submenu.php' );
require_once( 'inc/theme-options-footer.php' );
require_once( 'inc/theme-options-alternative.php' );
require_once( 'inc/header_logos.php' );
require_once( 'inc/color_profile.php' );
if( !function_exists('is_version') ) {
    function is_version( $version = '', $compare = '>=' ) {        
	if( $version != '' )	
        global $wp_version; 
        if( version_compare( $wp_version, $version, $compare ) ){
           	return false;
        } else {
        	return true;        		
        }
	}    
}
/**
 * Scouterna functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

if ( ! isset( $content_width ) ) $content_width = 428;

/**
 * Test if the current browser runs on a mobile device (smart phone, tablet, etc.)
 * Fork of wp_is_mobile() http://core.trac.wordpress.org/browser/tags/3.6.1/wp-includes/vars.php#L0
 * Will return false when on iPad
 * @return bool true|false
 */
function scout_is_mobile() {
		
	if ( isset( $is_mobile ) )
		return $is_mobile;
    if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
		$is_mobile = false;
	} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') ) {
		$is_mobile = false;
    } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
     	|| strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
        $is_mobile = true;
	} else {
    	$is_mobile = false;
	}
	
	return $is_mobile;
}
add_action( 'wp_enqueue_scripts', 'scout_enqueue_scripts' );
function scout_enqueue_scripts() {
	
	wp_enqueue_style( 'main',  get_bloginfo( 'stylesheet_url' ), array(), '2013' );	
	wp_enqueue_style( 'tablet',  get_template_directory_uri() . '/tablet.css', array( 'main' ), '2013', 'screen and (max-width: 768px)' );
	wp_enqueue_style( 'mobile',  get_template_directory_uri() . '/mobile.css', array( 'main', 'tablet' ), '2013', 'screen and (max-width: 640px)' );	
	if( true === scout_is_mobile() ) wp_enqueue_style( 'mobile',  get_template_directory_uri() . '/mobile.css', array( 'main' ), '2013' );
		
	wp_enqueue_script('main',  get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '2013', false );
	
	global $wp_styles;
	wp_enqueue_style( 'html5',  get_template_directory_uri() . '/js/html5.js', array(), '2013', false );
	$wp_styles->add_data( 'html5', 'conditional', 'lt IE 9' );
}
/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );
if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {
		
	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'scout', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'top', __( 'Top Menu', 'scout' ) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'main', __( 'Main Menu', 'scout' ) );

	// Add support for a variety of post formats
	# add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	$theme_options = twentyeleven_get_theme_options();
	if ( 'dark' == $theme_options['color_scheme'] )
		$default_background_color = '1d1d1d';
	else
		$default_background_color = 'f1f1f1';

	// Add support for custom backgrounds.
	add_theme_support( 'custom-background', array(
		// Let WordPress know what our default background color is.
		// This is dependent on our current color scheme.
		'default-color' => $default_background_color,
	) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
}
endif; // twentyeleven_setup

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'scout' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

// Use shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

	# register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Right column - Patches', 'scout' ),
		'id' => 'main-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="holder"><div class="frame"><div class="block">',
		'after_widget' => "</div></div></div></aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Right column - Ads', 'scout' ),
		'id' => 'ad-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Left column', 'scout' ),
		'id' => 'left-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Left column - Blog', 'scout' ),
		'description' => __( 'Displayed on the blog, blog archives and on single posts.', 'scout' ),
		'id' => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Start page - Big patches', 'scout' ),
		'id' => 'top-start-sidebar',
		'description' => __( 'The sidebar directly below the content', 'scout' ),
		'before_widget' => '<aside id="%1$s" class="box widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Start page - one column', 'scout' ),
		'id' => 'left-start-sidebar',
		'description' => __( 'The sidebar to the very left, one column.', 'scout' ),
		'before_widget' => '<div class="widget-wrapper"><hr class="box-top"><aside id="%1$s" class="box widget %2$s">',
		'after_widget' => '</aside><hr class="box-bottom"></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Start page - two columns', 'scout' ),
		'id' => 'two-column-start-sidebar',
		'description' => __( 'The sidebar next to the very left, two columns', 'scout' ),
		'before_widget' => '<aside id="%1$s" class="box widget %2$s"><div class="column"><div class="column-holder"><div class="column-frame"><div class="column-block">',
		'after_widget' => "</div></div></div></div></aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav($nav_id) {
	global $wp_query;

	$max_num_pages = $wp_query->max_num_pages;
	if( isset( $wp_query->query['paged'] ) ) $current_page = $wp_query->query['paged'];
	if(empty($current_page)) $current_page = 1;

	if($max_num_pages > 1) : ?>
		<nav class="post-navigation" id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e('Post navigation', 'scout'); ?></h3>
			<div class="nav-prev"><?php previous_posts_link(__('Previous page', 'scout')); ?>&nbsp;</div>
			<div class="nav-indicator"><?php printf(__('Page %1s of %2s', 'scout'), $current_page, $max_num_pages); ?></div>
			<div class="nav-next">&nbsp;<?php next_posts_link(__('Next page', 'scout')); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // twentyeleven_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'scout' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'scout' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'scout' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'scout' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'scout' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'scout' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'scout' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'scout' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'scout' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	if(is_page())
		global $post;
		$classes[] = "page-".$post->post_name;
	
	if( is_archive() ) {
		global $post;
		$posttype = get_post_type( $post->ID );
		if( 'post' === $posttype ) $classes[] = "blog";
	}

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );

/* Preamble style to WYISWYG-editor */
add_editor_style('custom-editor-style.css');


/* Image sizes */
add_image_size( 'main428', 428, 286, true );


/* Custom Read More Link */
function scout_excerpt_more($more) {
    global $post;
	return ' <a class="moretag" href="'. get_permalink($post->ID) . '" title="'.get_the_title().'">'.__('Read more', 'scout').' &raquo;'.'</a>';
}
add_filter('excerpt_more', 'scout_excerpt_more');


function is_child($page_id_or_slug) { 
	global $post; 
	if(!is_int($page_id_or_slug)) {
		$page = get_page_by_path($page_id_or_slug);
		$page_id_or_slug = $page->ID;
	} 
	if(is_page() && $post->post_parent == $page_id_or_slug ) {
       		return true;
	} else { 
       		return false; 
	}
}

function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/* Remove twentyeleven theme options from the admin menu */

add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
function adjust_the_wp_menu() {
	if( function_exists( 'remove_submenu_page' ) ) {
  		$page = remove_submenu_page( 'themes.php', 'theme_options' );
	}
}
add_action( 'after_setup_theme','remove_twentyeleven_options', 100 );
function remove_twentyeleven_options() {	
	if( function_exists( remove_theme_support( 'custom-header' )  ) ) {
		remove_theme_support( 'custom-header' ) ;		
	} else {
		remove_theme_support( 'custom-header' );
	}
}


/* Title attr on featured images */
add_action('post_thumbnail_html', 'hip_featured_images_title', 1, 5 );
function hip_featured_images_title( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	$attachment = get_post_thumbnail_id( $post_id );	
	$title = get_the_title( $attachment );
	$html = str_replace('<img', '<img title="' . $title . '" '  , $html);
	return $html;
}

/* Hide featured images if post password is needed (and not yet provided) */
add_action('post_thumbnail_html', 'hip_no_featured_image_on_password_protected_posts', 1, 5 );
function hip_no_featured_image_on_password_protected_posts( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	
	$post_password_is_required = post_password_required( $post_id );
	
	/* If the page itself isn't password protected, check if it's ancestors are */
	if( !$post_password_is_required && is_post_type_hierarchical( get_post_type() ) ) : // skip this check if the post type isn't hierarchical (ie. can't have children)
		global $post;
		$ancestors = $post->ancestors;
		// Loop through ancestors, grab the first one that is password protected
		foreach ( $ancestors as $ancestor ) :		
			if ( post_password_required( $ancestor ) ) {
				$post_password_is_required = true;
			}
		endforeach;
	endif; 
	
	/* If the post requires a password do not return the image html: */
  	if( $post_password_is_required ) :
	  	return false;
  	else :
  		return $html;
	endif;  	
}