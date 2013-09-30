<?php
/* HANDLE THE COLOR THEMES */
add_action( 'wp_head', 'scouterna_change_color_profile' );

function scouterna_change_color_profile() {
	$colorthemesettings = get_option( 'scout_colortheme_options' );
	$color = $colorthemesettings['color'];
	
	$scout_color_logo = '';
	$scout_color_h_a = '';
	$scout_color_assistive = '#003764';
	$nav_bg = 'bg-nav.png';
	
	switch ( $color ) {
		case "gron":
			$scout_color_logo = '#74c93e';
			$scout_color_h_a = '#447625';
			$scout_color_assistive = $scout_color_h_a;
			$nav_bg = 'bg-nav-gron.png';
			break;
		case "ljusbla":
			$scout_color_logo = '#46a4f7';
			$scout_color_h_a = '#2E6DA4';
			$scout_color_assistive = $scout_color_h_a;
			$nav_bg = 'bg-nav-ljusbla.png';
			break;
		case "orange":
			$scout_color_logo = '#fe7508';
			$scout_color_h_a = '#A94F05';
			$scout_color_assistive = $scout_color_h_a;
			$nav_bg = 'bg-nav-orange.png';
			break;
		case "magenta":
			$scout_color_logo = '#ed2377';
			$scout_color_h_a = '#C81E65';
			$scout_color_assistive = $scout_color_h_a;
			$nav_bg = 'bg-nav-magenta.png';
			break;
		case "gul":
			$scout_color_logo = '#D2CF06';
			$scout_color_h_a = '#6E6C03';
			$scout_color_assistive = $scout_color_h_a;
			$nav_bg = 'bg-nav-gul.png';
			break;
		case "gra":
			$scout_color_logo = '#353535';
			$scout_color_h_a = '#353535';
			$scout_color_assistive = $scout_color_h_a;
			$nav_bg = 'bg-nav-gra.png';
			break;		
	}

	if( $color != 'scoutbla' || empty( $color ) ){
		echo '<style type="text/css">
		a{
			color: ' . $scout_color_h_a . ';
		}
		h1, 
		h1 a, 
		h2, 
		h2 a,
		h3, 
		h3 a,
		h4, 
		h4 a, 
		h5, 
		h5 a,
		h6, 
		h6 a{
			color: ' . $scout_color_h_a . ';
		}
		.logo-child a{
			color: ' . $scout_color_logo . ';
		}
		#nav {
			background: url("' . get_bloginfo('template_url') . '/images/' . $nav_bg . '") no-repeat;
			text-decoration: none;
		}
		#nav a:focus, #nav a:active {
			background:url("' . get_bloginfo('template_url') . '/images/bg-nav-hover.png");
		}
		.boxes .box h2 {
			color: ' . $scout_color_h_a . ';
		}
		.nav-add a:focus,
		.nav-add a:active {
			color: #ffffff;
		}
		.entry-content a:focus,
		.entry-content a:active,
		.mainwidgets a:focus,
		.mainwidgets a:active,
		.nav-sub a:focus,
		.nav-sub a:active,
		.boxes .box p a:focus,
		.boxes .box p a:active,
		.columns a:focus,
		.columns a:active,
		#footer a:focus,
		#footer a:active {
			background: ' . $scout_color_assistive . ';
			color: #ffffff;
		}
		.jcarousel-control a:focus,
		.jcarousel-control a:active {
			background: url("' . get_bloginfo('template_url') . '/images/bg-promo-list-hover3.png") no-repeat;
			color: #fff;
		}
		.columns .column .widget-title {
			color: ' . $scout_color_h_a . ';
		}
		.location h2 {
			color: ' . $scout_color_h_a . ';
		}
		.location .aside h2 {
			color: ' . $scout_color_h_a . ';
		}
		#content h1 {
			color: ' . $scout_color_h_a . ';
		}
		#content h2 {
			color: ' . $scout_color_h_a . ';
		}
		#content h3 {
			color: ' . $scout_color_h_a . ';
		}
		#content .gform_wrapper .top_label .gfield_label {
			color: ' . $scout_color_h_a . ';
		}
		#sidebar ul a {
			color: ' . $scout_color_h_a . ';
		}
		#sidebar ul a:focus, #sidebar ul a:active {
			background: ' . $scout_color_assistive . ';
			color: #ffffff;
		}
		.mainwidgets .widget-title{
			color: ' . $scout_color_h_a . ';
		}
		#sidebar .widget-title{
			color: ' . $scout_color_h_a . ';
		}
		#content .wpv-filter-form .filtrera-marken label,
		#content .wpv-filter-form .filtrera-marken label .labeltext {
		   color: ' . $scout_color_h_a . ';
		}
		</style>';
	}
}