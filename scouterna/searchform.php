<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search on', 'scout' ); ?></label>
		<span class="text">
			<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search on', 'scout' ); echo ' ' . $_SERVER['HTTP_HOST']; ?>" />
		</span>		
		<input type="submit" class="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'scout' ); ?>" />
	</form>
