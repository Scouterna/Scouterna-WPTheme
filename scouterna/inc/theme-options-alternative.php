<?php
/* HANDLE ALL THE OPTIONS PAGES UNDER THE MENU ITEM ALTERNATIV */

add_action( 'admin_init', 'scouterna_alt_options_init' );
add_action( 'admin_menu', 'scouterna_alt_options_add_pages' );
add_action( 'admin_enqueue_scripts', 'scouterna_alt_options_js' ); 

function scouterna_alt_options_init() { // whitelist options
	register_setting( 'scouterna_logo_options', 'scout_logo_options');
    register_setting( 'scouterna_colortheme_options', 'scout_colortheme_options');
}

/**
 * Create option menu for Alternativ
 */
function scouterna_alt_options_add_pages() {
	add_theme_page( __( 'Logo', 'scout' ), __( 'Logo', 'scout' ), 'edit_posts', 'scouterna-alternativ', 'scouterna_logo_options_do_page' );
	add_theme_page( __( 'Colour profile', 'scout' ), __( 'Colour profile', 'scout' ), 'edit_posts', 'scouterna-alternativ-colortheme', 'scouterna_colortheme_options_do_page' );
}

/**
 * Create the logo option page
 */
function scouterna_logo_options_do_page() {
	
	$version_less_than_3_5 = is_version( '3.5', '<' );	
	
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	
	if( $version_less_than_3_5 === false ) {
		scouterna_logo_options_below_3_5();
	} else {
		scouterna_logo_options_above_3_5();
	}

}
function scouterna_logo_options_above_3_5() {
	?>
	<div class="wrap">
		<?php screen_icon('options-general'); echo "<h2>" . __( 'Logo', 'scout' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Settings saved', 'scout' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php 
				$options = get_option( 'scout_logo_options' );
				settings_fields( 'scouterna_logo_options' );
				
			?>
			<h3>
				<?php _e( 'Main logo', 'scout' ); ?>
			</h3>
			
			<h4>
				<?php echo __('Image logo', 'scout') . ' ' . __( '(text must be in the image)', 'scout' ); ?>
			</h4>
			<p>
				
				<img class="custom_media_image" src="<?php echo $options['main']['logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="hidden" class="custom_media_url" name="scout_logo_options[main][logo_url]" id="scout_logo_options_main_logourl" value="<?php echo $options['main']['logo_url']; ?>">
				<input type="hidden" class="custom_media_id" name="scout_logo_options[main][logo_id]" id="scout_logo_options_main_logoid" value="<?php echo $options['main']['logo_id']; ?>">
     	
				<input type="button" value="<?php _e( 'Upload/select image', 'scout' ); ?>" class="button custom_media_upload" id="scout_logo_options_main_logoid_button"/>
                <input type="button" value="<?php _e( 'Remove image', 'scout' ); ?>" class="button custom_media_remove" id="scout_logo_options_main_logoid_removebutton"/>
			</p>
			
			<h4>
				<?php echo __('Textbased logo', 'scout').' '.__('(only text, Scout logo is displayed as an image)', 'scout'); ?>
			</h4>
			<p>
				<label for="scout_logo_options_main_logostrong"><?php _e('Bold text', 'scout'); ?></label><br/>
				<input id="scout_logo_options_logostrong" type="text" name="scout_logo_options[main][logo_strong]" value="<?php echo $options['main']['logo_strong'] ?>" />
			</p>
			<p>
				<label for="scout_logo_options_main_logonormal"><?php _e('Normal text', 'scout'); ?></label><br/>
				<input id="scout_logo_options_logonormal" type="text" name="scout_logo_options[main][logo_normal]" value="<?php echo $options['main']['logo_normal'] ?>" />
			</p>
			
			<h3>
				<?php _e( 'Logos and icons', 'scout' ); ?>
			</h3>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Logo on Facebook', 'scout'); ?></label><br/>
				<small><?php _e('Recommended size is 155px wide and 114px high.', 'scout'); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['facebook_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="hidden" class="custom_media_url" name="scout_logo_options[misc][facebook_logo_url]" id="scout_logo_options_misc_facebook_logourl" value="<?php echo $options['misc']['facebook_logo_url']; ?>">
				<input type="hidden" class="custom_media_id" name="scout_logo_options[misc][facebook_logo_id]" id="scout_logo_options_misc_facebook_logoid" value="<?php echo $options['misc']['facebook_logo_id']; ?>">
     	
				<input type="button" value="<?php _e( 'Upload/select image', 'scout' ); ?>" class="button custom_media_upload" id="scout_logo_options_misc_facebook_logoid_button"/>
                <input type="button" value="<?php _e( 'Remove image', 'scout' ); ?>" class="button custom_media_remove" id="scout_logo_options_misc_facebook_removebutton"/>
			</p>
			<p>
				<label for="scout_logo_options_misc_favicon_logoid"><?php _e('Favicon', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .ico', '16x16px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['favicon_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="hidden" class="custom_media_url" name="scout_logo_options[misc][favicon_logo_url]" id="scout_logo_options_misc_favicon_logourl" value="<?php echo $options['misc']['favicon_logo_url']; ?>">
				<input type="hidden" class="custom_media_id" name="scout_logo_options[misc][favicon_logo_id]" id="scout_logo_options_misc_favicon_logoid" value="<?php echo $options['misc']['favicon_logo_id']; ?>">
     	
				<input type="button" value="<?php _e( 'Upload/select image', 'scout' ); ?>" class="button custom_media_upload" id="scout_logo_options_misc_favicon_logoid_button"/>
                <input type="button" value="<?php _e( 'Remove image', 'scout' ); ?>" class="button custom_media_remove" id="scout_logo_options_misc_favicon_logoid_removebutton"/>
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPhone', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '57x57px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['iphone_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="hidden" class="custom_media_url" name="scout_logo_options[misc][iphone_logo_url]" id="scout_logo_options_misc_iphone_logourl" value="<?php echo $options['misc']['iphone_logo_url']; ?>">
				<input type="hidden" class="custom_media_id" name="scout_logo_options[misc][iphone_logo_id]" id="scout_logo_options_misc_iphone_logoid" value="<?php echo $options['misc']['iphone_logo_id']; ?>">
     	
				<input type="button" value="<?php _e( 'Upload/select image', 'scout' ); ?>" class="button custom_media_upload" id="scout_logo_options_misc_iphone_logoid_button"/>
                <input type="button" value="<?php _e( 'Remove image', 'scout' ); ?>" class="button custom_media_remove" id="scout_logo_options_misc_iphone_logoid_removebutton"/>
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPhone (retina)', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '114x114px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['iphoneretina_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="hidden" class="custom_media_url" name="scout_logo_options[misc][iphoneretina_logo_url]" id="scout_logo_options_misc_iphoneretina_logourl" value="<?php echo $options['misc']['iphoneretina_logo_url']; ?>">
				<input type="hidden" class="custom_media_id" name="scout_logo_options[misc][iphoneretina_logo_id]" id="scout_logo_options_misc_iphoneretina_logoid" value="<?php echo $options['misc']['iphoneretina_logo_id']; ?>">
     	
				<input type="button" value="<?php _e( 'Upload/select image', 'scout' ); ?>" class="button custom_media_upload" id="scout_logo_options_misc_iphoneretina_logoid_button"/>
                <input type="button" value="<?php _e( 'Remove image', 'scout' ); ?>" class="button custom_media_remove" id="scout_logo_options_misc_iphoneretina_logoid_removebutton"/>
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPad', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '72x72px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['ipad_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="hidden" class="custom_media_url" name="scout_logo_options[misc][ipad_logo_url]" id="scout_logo_options_misc_ipad_logourl" value="<?php echo $options['misc']['ipad_logo_url']; ?>">
				<input type="hidden" class="custom_media_id" name="scout_logo_options[misc][ipad_logo_id]" id="scout_logo_options_misc_ipad_logoid" value="<?php echo $options['misc']['ipad_logo_id']; ?>">
     	
				<input type="button" value="<?php _e( 'Upload/select image', 'scout' ); ?>" class="button custom_media_upload" id="scout_logo_options_misc_ipad_logoid_button"/>
                <input type="button" value="<?php _e( 'Remove image', 'scout' ); ?>" class="button custom_media_remove" id="scout_logo_options_misc_ipad_logoid_removebutton"/>
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPad (retina)', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '144x144px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['ipadretina_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="hidden" class="custom_media_url" name="scout_logo_options[misc][ipadretina_logo_url]" id="scout_logo_options_misc_ipadretina_logourl" value="<?php echo $options['misc']['ipadretina_logo_url']; ?>">
				<input type="hidden" class="custom_media_id" name="scout_logo_options[misc][ipadretina_logo_id]" id="scout_logo_options_misc_ipadretina_logoid" value="<?php echo $options['misc']['ipadretina_logo_id']; ?>">
     	
				<input type="button" value="<?php _e( 'Upload/select image', 'scout' ); ?>" class="button custom_media_upload" id="scout_logo_options_misc_ipadretina_logoid_button"/>
                <input type="button" value="<?php _e( 'Remove image', 'scout' ); ?>" class="button custom_media_remove" id="scout_logo_options_misc_ipadretina_logoid_removebutton"/>
			</p>
				
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save settings', 'scout' ); ?>" />
			</p>
		</form>
	</div>
<?php
}
function scouterna_logo_options_below_3_5() {
	?>
	<div class="wrap">
		<?php screen_icon('options-general'); echo "<h2>" . __( 'Logo', 'scout' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Settings saved', 'scout' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php 
				$options = get_option( 'scout_logo_options' );
				settings_fields( 'scouterna_logo_options' );
				
			?>
			<h3>
				<?php _e( 'Main logo', 'scout' ); ?>
			</h3>
			
			<h4>
				<?php echo __('Image logo', 'scout') . ' ' . __( '(text must be in the image)', 'scout' ); ?>
			</h4>
			<p>
				
				<img class="custom_media_image" src="<?php echo $options['main']['logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="text" class="custom_media_url" name="scout_logo_options[main][logo_url]" id="scout_logo_options_main_logourl" value="<?php echo $options['main']['logo_url']; ?>">
				
			</p>
			
			<h4>
				<?php echo __('Textbased logo', 'scout').' '.__('(only text, Scout logo is displayed as an image)', 'scout'); ?>
			</h4>
			<p>
				<label for="scout_logo_options_main_logostrong"><?php _e('Bold text', 'scout'); ?></label><br/>
				<input id="scout_logo_options_logostrong" type="text" name="scout_logo_options[main][logo_strong]" value="<?php echo $options['main']['logo_strong'] ?>" />
			</p>
			<p>
				<label for="scout_logo_options_main_logonormal"><?php _e('Normal text', 'scout'); ?></label><br/>
				<input id="scout_logo_options_logonormal" type="text" name="scout_logo_options[main][logo_normal]" value="<?php echo $options['main']['logo_normal'] ?>" />
			</p>
			
			<h3>
				<?php _e( 'Logos and icons', 'scout' ); ?>
			</h3>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Logo on Facebook', 'scout'); ?></label><br/>
				<small><?php _e('Recommended size is 155px wide and 114px high.', 'scout'); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['facebook_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="text" class="custom_media_url" name="scout_logo_options[misc][facebook_logo_url]" id="scout_logo_options_misc_facebook_logourl" value="<?php echo $options['misc']['facebook_logo_url']; ?>">
				
			</p>
			<p>
				<label for="scout_logo_options_misc_favicon_logoid"><?php _e('Favicon', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .ico', '16x16px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['favicon_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="text" class="custom_media_url" name="scout_logo_options[misc][favicon_logo_url]" id="scout_logo_options_misc_favicon_logourl" value="<?php echo $options['misc']['favicon_logo_url']; ?>">
				
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPhone', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '57x57px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['iphone_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="text" class="custom_media_url" name="scout_logo_options[misc][iphone_logo_url]" id="scout_logo_options_misc_iphone_logourl" value="<?php echo $options['misc']['iphone_logo_url']; ?>">
				
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPhone (retina)', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '114x114px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['iphoneretina_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="text" class="custom_media_url" name="scout_logo_options[misc][iphoneretina_logo_url]" id="scout_logo_options_misc_iphoneretina_logourl" value="<?php echo $options['misc']['iphoneretina_logo_url']; ?>">
				
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPad', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '72x72px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['ipad_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="text" class="custom_media_url" name="scout_logo_options[misc][ipad_logo_url]" id="scout_logo_options_misc_ipad_logourl" value="<?php echo $options['misc']['ipad_logo_url']; ?>">
				
			</p>
			<p>
				<label for="scout_logo_options_misc_facebook_logoid"><?php _e('Favicon iPad (retina)', 'scout'); ?></label><br/>
				<small><?php _e( sprintf( 'Recommended size is %s. Filetype .png', '144x144px' ), 'scout' ); ?></small>
				<img class="custom_media_image" src="<?php echo $options['misc']['ipadretina_logo_url']; ?>" style="margin:5px 0;padding:0;max-width:100%;display:block" />
				<input type="text" class="custom_media_url" name="scout_logo_options[misc][ipadretina_logo_url]" id="scout_logo_options_misc_ipadretina_logourl" value="<?php echo $options['misc']['ipadretina_logo_url']; ?>">
				
			</p>
				
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save settings', 'scout' ); ?>" />
			</p>
		</form>
	</div>
<?php
}
/**
 * Create the colortheme option page
 */
function scouterna_colortheme_options_do_page() {
	

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon('options-general'); echo "<h2>" . __( 'Colour profile', 'scout' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Settings saved', 'scout' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php 
				$options = get_option( 'scout_colortheme_options' );
				settings_fields( 'scouterna_colortheme_options' );
				
				$colors = array(
					'scoutbla' => array( 'colortext' => __('Dark blue', 'scout'), 'description' => __('(standard color, represents stability, trust, established)', 'scout')),
					'gron' => array( 'colortext' => __('Green', 'scout'), 'description' => __('(spårarscouter, stands for curiosity, trying, nature, fantasy and fun)', 'scout')),
					'ljusbla' => array( 'colortext' => __('Light blue', 'scout'), 'description' => __('(upptäckarscouter, stands for courage, cooperation, willingness, solving problems and the world)', 'scout')),
					'orange' => array( 'colortext' => __('Orange', 'scout'), 'description' => __('(äventyrarscouter, stands for awareness, respect, outdoor activities, patrol and meetings)', 'scout')),
					'magenta' => array( 'colortext' => __('Magenta', 'scout'), 'description' => __('(utmanarscouter, stands for commitment, reflect, network, international and community)', 'scout')),
					'gul' => array( 'colortext' => __('Yellow', 'scout'), 'description' => __('(roverscouter, represents limitlessness, ready, develop, leadership and listening and support)', 'scout')),
					'gra' => array( 'colortext' => __('Grey', 'scout'), 'description' => __('(neutral colour)', 'scout'))
				);
			?>
			<h3>
				<?php _e( 'Change colour profile', 'scout' ); ?>
			</h3>
			<ul>
				<?php
					foreach($colors as $color => $info){
						if( $options['color'] == $color ){
							$checked = 'checked="checked"';
						}
						else{
							$checked = "";
						}
						?>
						<li>
							<input id="scout_colortheme_options_<?php echo $color; ?>" type="radio" name="scout_colortheme_options[color]" value="<?php echo $color; ?>" <?php echo $checked; ?> /> <label for="scout_colortheme_options_<?php echo $color; ?>"><?php echo $info['colortext']; ?></label> <?php echo $info['description']; ?>
						</li>
					<?php
					}
				?>
				
			</ul>
				
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save settings', 'scout' ); ?>" />
			</p>
		</form>
	</div>
	
	<?php
}


function scouterna_alt_options_js( ) {
	if( isset( $_GET['page'] ) ) { 
		if( $_GET['page'] != 'scouterna-alternativ' )
			return;
	
	wp_enqueue_script( 'jquery' );
    
    $version_less_than_3_5 = is_version( '3.5', '<' );	
	if( $version_less_than_3_5 === true ) {
		wp_enqueue_media();
	}
	
	wp_register_script( 'theme-options-alternative', get_template_directory_uri(). '/inc/theme-options-alternative.js', array('jquery'));
    wp_enqueue_script( 'theme-options-alternative' );
	
	$translation = array( 'select_image' => __( 'Choose image', 'scout' ), 'insert_image' => __( 'Choose image as logo', 'scout' ) );
	wp_localize_script( 'theme-options-alternative', 'theme_options_alternative_strings', $translation );
	}
} 