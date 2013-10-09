<?php

add_action( 'admin_init', 'scouterna_footer_options_init' );
add_action( 'admin_menu', 'scouterna_footer_options_add_page' );

function scouterna_footer_options_init() { // whitelist options
    register_setting( 'scouterna_footer_options', 'scout_footer_options');
}


/**
 * Load up the menu page
 */
function scouterna_footer_options_add_page() {
	add_theme_page( __( 'Footer', 'scout' ), __( 'Footer', 'scout' ), 'manage_options', 'footer_options', 'scouterna_footer_options_do_page' );
}


/**
 * Create the footer option page
 */
function scouterna_footer_options_do_page() {
	

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . __( 'Footer settings', 'scout' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Settings saved', 'scout' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php 
				$options = get_option( 'scout_footer_options' );
				settings_fields( 'scouterna_footer_options' );
			?>
			<h3><?php _e( 'Contact Information', 'scout' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<td>
						<p>
							<label class="description" for="scout_footer_options_contact_phone"><?php _e( 'Phone', 'scout' ); ?></label><br>
							<input id="scout_footer_options_contact_phone" class="regular-text" type="text" name="scout_footer_options[contact][phone]" value="<?php echo esc_attr( $options['contact']['phone'] ); ?>" />
						</p>
						<p>
							<label class="description" for="scout_footer_options_contact_email"><?php _e( 'E-mail address', 'scout' ); ?></label><br>
							<input id="scout_footer_options_contact_email" class="regular-text" type="text" name="scout_footer_options[contact][email]" value="<?php echo esc_attr( $options['contact']['email'] ); ?>" />
						</p>
						<p>
                            <label class="description" for="scout_footer_options_contact_address"><?php _e( 'Address', 'scout' ); ?></label><br>
                            <input id="scout_footer_options_contact_address" class="regular-text" type="text" name="scout_footer_options[contact][address]" value="<?php echo esc_attr( $options['contact']['address'] ); ?>" />
                        </p>
						<p>
							<label class="description" for="scout_footer_options_contact_page"><?php _e( 'Link to contact page', 'scout' ); ?></label><br>
							<input id="scout_footer_options_contact_page" class="regular-text" type="text" name="scout_footer_options[contact][contact_page]" value="<?php echo esc_attr( $options['contact']['contact_page'] ); ?>" />
						</p>
						<p>
							<label class="description" for="scout_footer_options_about_page"><?php _e( 'Link to page with information about the website', 'scout' ); ?></label><br>
							<input id="scout_footer_options_about_page" class="regular-text" type="text" name="scout_footer_options[contact][about_page]" value="<?php echo esc_attr( $options['contact']['about_page'] ); ?>" />
						</p>
					</td>
				</tr>
			</table>
		

			<h3><?php _e( 'Social networks', 'scout' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<td>
						<p>
							<img src="<?php echo get_template_directory_uri();?>/images/icon_fb.png" width="20" height="20">
							<label class="description" for="scout_footer_options_social_fb"><?php _e( 'Full URL to Facebook page', 'scout' ); ?> <?php _e('(incl http://)', 'scout'); ?></label><br>
							<input id="scout_footer_options_social_fb" class="regular-text" type="text" name="scout_footer_options[social][fb]" value="<?php echo esc_attr( $options['social']['fb']); ?>" />
						</p>
						<p>
							<img src="<?php echo get_template_directory_uri();?>/images/icon_gplus.png" width="20" height="20">
							<label class="description" for="scout_footer_options[social][gplus]"><?php _e( 'Full URL to Google+ page', 'scout' ); ?> <?php _e('(incl http://)', 'scout'); ?></label><br>
							<input id="scout_footer_options[social][gplus]" class="regular-text" type="text" name="scout_footer_options[social][gplus]" value="<?php echo esc_attr( $options['social']['gplus']); ?>" />
						</p>
						<p>
							<img src="<?php echo get_template_directory_uri();?>/images/icon_youtube.png" width="20" height="20">
							<label class="description" for="scout_footer_options_social_youtube"><?php _e( 'Full URL to YouTube page', 'scout' ); ?> <?php _e('(incl http://)', 'scout'); ?></label><br>
							<input id="scout_footer_options_social_youtube" class="regular-text" type="text" name="scout_footer_options[social][youtube]" value="<?php echo esc_attr( $options['social']['youtube']); ?>" />
						</p>
						<p>
							<img src="<?php echo get_template_directory_uri();?>/images/icon_instagram.png" width="20" height="20">
							<label class="description" for="scout_footer_options_social_instagram"><?php _e( 'Username on Instagram', 'scout' ); ?></label><br>
							<input id="scout_footer_options_social_instagram" class="regular-text" type="text" name="scout_footer_options[social][instagram]" value="<?php echo esc_attr( $options['social']['instagram'] ); ?>" />
						</p>
						<p>
							<img src="<?php echo get_template_directory_uri();?>/images/icon_twitter.png" width="20" height="20">
							<label class="description" for="scout_footer_options_social_twitter"><?php _e( 'Username on Twitter', 'scout' ); ?></label><br>
							<input id="scout_footer_options_social_twitter" class="regular-text" type="text" name="scout_footer_options[social][twitter]" value="<?php echo esc_attr( $options['social']['twitter'] ); ?>" />
						</p>
					</td>
				</tr>
			</table>

			<h3><?php _e( 'Other', 'scout' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<td>
						<?php
							$content = $options['rich_text_field'];
							if( function_exists( 'wp_editor' ) ) :
								
								$settings = array(
									'textarea_name' => 'scout_footer_options[rich_text_field]',
									'textarea_rows' => 7
								);
								wp_editor( $content, 'scout_footer_rich_text_field', $settings );
							else : 
								echo "<textarea name='scout_footer_options[rich_text_field]' rows='7' cols='40'>$content</textarea>"; 
							endif;
						?>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save settings', 'scout' ); ?>" />
			</p>
		</form>


	</div>
	<?php
} // adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/