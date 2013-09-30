<?php
/* HANDLE THE LOGOS IN THE HEADER */

function scouterna_display_header_logos(){
	$logosettings = get_option( 'scout_logo_options' );
	$logoimg = $logosettings['main']['logo_url'];
	$logostrong = $logosettings['main']['logo_strong'];
	$logonormal = $logosettings['main']['logo_normal'];
	
	if( $logoimg != "" || $logostrong != "" || $logonormal != "" ){
		$displaycustomlogo = true;
	}
	else{
		$displaycustomlogo = false;
	}
	
	/* display a custom logo. Image or Plain text logo */
	if( $displaycustomlogo ){
		if( $logoimg != "" ){
			/* display image logo */
			$display_logo = scouterna_display_image_logo( $logoimg );
			
		}
		else{
			/* display plain text logo */
			$display_logo = scouterna_display_plaintext_logo( $logostrong, $logonormal );
		}
	}
	else{
		/* display the default logo */
		$display_logo = scouterna_display_default_logo( );
	}
	
	return $display_logo;
}

				
function scouterna_display_image_logo( $logoimg ){
	$output = scouterna_display_main_scout_logo();
	$output .= '
		<div class="logo-child">
			<span>
				<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">
					<img src="'.$logoimg.'" alt="'.esc_attr(  get_bloginfo( 'name' ) ).'" />
				</a>
			</span>
		</div>';
	
	if(is_front_page() || is_home() ){
		$output .= '
			<hgroup>
				<h1 id="site-title">
					<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">
						'.get_bloginfo( 'name' ).'
					</a>
				</h1>	
			</hgroup>';	
	}
	
	return $output;
}

function scouterna_display_plaintext_logo( $logostrong, $logonormal ){
		
	$colorthemesettings = get_option( 'scout_colortheme_options' );
	$scoutlilja = '';
	
	/* get the right scout logo colour */
	if ( empty( $colorthemesettings ) ) {
		$scoutlilja = 'images/scoutlilja-scoutbla.png';
	} else {		
		$scoutlilja = 'images/scoutlilja-'.$colorthemesettings['color'].'.png';
	}
	$output = scouterna_display_main_scout_logo();
	$output .= "<img class='lilja' src='" . get_template_directory_uri() . "/$scoutlilja' width='61' height='61' alt='Scoutlilja' />";
             
	/* If we're on the front page, put the text in a heading */
	if(is_front_page() || is_home() ){
		$output .= '
			<hgroup class="logoplain">
				<h1 id="site-title" class="logo-child">
					<span>
						<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">
							<span class="logobold">'.$logostrong.'</span>'.$logonormal.'
						</a>
					</span>
				</h1>	
			</hgroup>';
	}
	else{
		$output .= '
			<div id="site-title" class="logo-child">
				<span>
					<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">
						<span class="logobold">'.$logostrong.'</span>'.$logonormal.'
					</a>
				</span>
			</div>';
	}
	
	return $output;
}

function scouterna_display_default_logo(){
	$output = '
		<div id="site-title" class="logo">
			<span>
				<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">
					<img src="'.get_bloginfo('template_url').'/images/logo.png" width="376" height="138" alt="'.esc_attr(  get_bloginfo( 'name' ) ).'" />
				</a>
			</span>
		</div>';
	
	if(is_front_page() || is_home() ){
		$output .= '
			<hgroup>
				<h1 id="site-title">
					<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">
						'.esc_attr(  get_bloginfo( 'name' ) ).'
					</a>
				</h1>	
			</hgroup>';
	}
	
	return $output;
}

function scouterna_display_main_scout_logo(){
	if( scout_is_mobile() ){
		$output = '
			<div class="logo style-2">
				<a href="http://www.scouterna.se/">' . __( 'The Scouts', 'scout' ) . '</a>
			</div>';
	}
	else{
		$output = '<a href="http://www.scouterna.se" title="' . __( 'The Scouts', 'scout' ) . '" class="logo-link">' . __( 'The Scouts', 'scout' ) . '</a>';
	}
	
	return $output;
}