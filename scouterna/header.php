<?php
/**
 * The Header for our theme
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0" />
<?php
    global $post;
    $logosettings = get_option( 'scout_logo_options' );
    $favic = $logosettings['misc']['favicon_logo_url'];
    $iosic57 = $logosettings['misc']['iphone_logo_url'];
    $iosic114 = $logosettings['misc']['iphoneretina_logo_url'];
    $iosic72 = $logosettings['misc']['ipad_logo_url'];
    $iosic144 = $logosettings['misc']['ipadretina_logo_url'];

    if( is_object( $post ) && wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ) {
        $fbimage = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    }
    elseif( $logosettings['misc']['facebook_logo_url'] ){
        $fbimage = $logosettings['misc']['facebook_logo_url'];
    }
    else{
        $fbimage = get_bloginfo('template_url').'/images/logo.png';
    }
?>
<meta property="og:image" content="<?php echo $fbimage; ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $favic; ?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $iosic57; ?>" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $iosic72; ?>" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $iosic114; ?>" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $iosic144; ?>" />

<title>
    <?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        echo " | $site_description";
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
        echo ' | ' . sprintf( __( 'Page %s', 'scout' ), max( $paged, $page ) );
    }
        ?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
    wp_enqueue_script( 'jquery' );
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
?>

</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
    <div class="skip-link">
        <a class="assistive-text-main" href="#main"
           title="<?php esc_attr_e( 'Skip to content', 'scout' ); ?>">
           <?php _e( 'Skip to content', 'scout' ); ?>
        </a>
    </div>
    <div class="w1">
        
        <header id="header" role="banner">
            <?php if ($scout_display_global_nav) { ?>
            <nav class="nav-add">
            <div class="menu-sajtnavigation-container">
                <ul id="menu-sajtnavigation" class="add-nav">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a title="Scouterna" href="http://www.scouterna.se/">Scouterna</a>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a title="Service" href="http://www.scoutservice.se/">Scoutservice</a>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a title="Folkhögskola" href="http://www.scouternasfolkhogskola.se/">Scouternas folkhögskola</a>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a title="Shop" href="http://www.scoutshop.se/">Scoutshop</a>
                    </li>
                </ul>
            </div>
            </nav>
            <?php } ?>
            
            <div class="holder">
                <?php
                    echo scouterna_display_header_logos();
                
                    get_search_form(); 
                ?>
                
                <nav class="nav-sub">
                    <?php
                        wp_nav_menu( array( 'theme_location' => 'top',
                                            'menu_class' => 'sub-nav',
                                            'fallback_cb' => false,
                                            'depth'           => 1 ) );
                    ?>
                </nav>
            </div><!-- .holder -->
            
            <!-- navigation -->
            <nav id="access" role="navigation">
                <?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assigned to the primary location is the one used. If one isn't assigned, no menu will be shown. */ ?>
                <?php 
                    wp_nav_menu( array( 'theme_location' => 'main',
                                        'menu_id' => 'nav',
                                        'container_class' => 'menu-main-container',
                                        'fallback_cb' => false,
                                        'depth'           => 1 ) );
                ?>
            </nav><!-- #access -->
            
                
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-form">
                <fieldset>
                    <span class="text">
                        <input type="text" name="s" value="<?php
                        echo __('Search on', 'scout');
                        echo ' '.$_SERVER['HTTP_HOST'];
                        ?>" />
                    </span>
                </fieldset>
            </form>
            
            <?php
            $fields = get_option('scout_footer_options');
                if(!empty($fields)) {
                    if(!empty($fields['contact'])) {
                        if(!empty($fields['contact']['contact_page'])) 
                        {
                            echo '<a href="'.$fields['contact']['contact_page'].
                                 '" class="contact-link">'.__('Contact', 'scout').'</a>';
                        }
                    }
                }
            ?>
        </header><!-- #header -->


    <div id="main">
    <?php if( !is_front_page() && !is_search() ) {
         if( function_exists( 'bcn_display' ) ) { ?>
            <div class="breadcrumbs">
                <?php bcn_display(); ?>
            </div>
        <?php }
            $menuid = "";
            if( function_exists( 'hip_folded_submenu' ) )
            {
                if( hip_folded_submenu('none') != "" )
                {
                    $menuid = "-two-menu";
                } else {
                    $menuid = "";
                }
            }
                    
            if( get_post_type() == 'post')
            { 
                if( is_author() ||
                    is_category() ||
                    is_tag() ||
                    is_date() ||
                    is_home() ||
                    is_singular( 'post' ) )
                {
                    get_template_part('sidebar', 'blog');
                }
            } else if( !is_front_page() &&
                       !is_404() &&
                       $menuid =! "" &&
                       !is_page_template('page-fullwidth.php'))
            {    
                get_template_part('sidebar', 'placeholder');
            }
                
        }