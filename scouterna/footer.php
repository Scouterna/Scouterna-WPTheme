<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

		</div><!-- #main -->

		<footer id="footer" role="contentinfo">
			<div class="footer-holder">

				<?php
					 	$fields = get_option( 'scout_footer_options' );
						if( empty( $fields ) ) {
							dynamic_sidebar( 'footer-sidebar' );
							echo '<div class="footer_cookies">';
								echo __( 'This website uses cookies.', 'scout' );
							echo '</div>';
						} else {
							echo "<div class=\"footer_info\">";
								if( !empty( $fields['contact'] ) ) {
									if(!empty( $fields['contact']['phone'] ) ){
										$contact_phone = $fields['contact']['phone'];
										$contact_phone_linked = preg_replace("/[^0-9]/","",$contact_phone);
										$contact_phone_linked = '+46'.substr( $contact_phone_linked, 1 );
									}
									echo "<div class=\"footer_contact footer_section footer_section_1\">";
										echo "<h2 class=\"title\">". get_bloginfo('name') ."</h2>";
                                        echo "<ul>";
										if( !empty( $fields['contact']['phone'])) echo "<li><strong>" . __( 'Phone number', 'scout' ) . ":</strong> <a class=\"phone\" href=\"tel:".$contact_phone_linked."\">" . $contact_phone . "</a></li>";
										if( !empty( $fields['contact']['email'])) echo "<li><strong>" .__( 'E-mail', 'scout' ) . ":</strong> <a href=\"mailto:" . $fields['contact']['email'] . "\">" . $fields['contact']['email'] . "</a></li>";
										if( !empty( $fields['contact']['address'])) echo "<li><strong>" . __( 'Address', 'scout' ) . ":</strong> " . $fields['contact']['address'] . "</li>";
										if( !empty( $fields['contact']['contact_page'])) echo "<li class=\"contact\"><a href=\"" . $fields['contact']['contact_page'] . "\">" . __( 'More contact information', 'scout' ) . " &raquo;</a></li>";
										if( !empty( $fields['contact']['about_page'])) echo "<li class=\"about_page\">" . __( 'This website uses cookies.', 'scout' ) . "<br><a href=\"" . $fields['contact']['about_page'] . "\">" . __( 'About this website', 'scout' ) . " &raquo;</a></li>";
										if( empty($fields['contact']['about_page'])) echo "<li class=\"about_page\">" . __( 'This website uses cookies.', 'scout' ) . "</li>";
                                        echo "</ul>";
									echo "</div>";
								}
								if( empty($fields['contact'])) {
									echo "<div class=\"footer_contact footer_section footer_section_1\">";
										echo "<h2 class=\"title\">". get_bloginfo('name') ."</h2>";
                                        echo "<ul>";
											echo "<li class=\"about_page\">" . __( 'This website uses cookies.', 'scout' ) . "</li>";
                                        echo "</ul>";
									echo "</div>";
								}
								if( !empty( $fields['social'])) {
									echo "<div class=\"footer_social footer_section footer_section_2\">";
										$imagedir = get_template_directory_uri() . "/images";
										if( !empty( $fields['social']['fb'] ) ) echo "<a href=\"" . $fields['social']['fb'] . "\"><img src=\"$imagedir/icon_fb.png\" alt=\"Facebook icon\" width=\"30\" height=\"30\"><span>" . __( 'Find us on', 'scout' ) . " Facebook</span></a>";
										if( !empty( $fields['social']['gplus'] ) ) echo "<a href=\"" . $fields['social']['gplus'] . "\"><img src=\"$imagedir/icon_gplus.png\" alt=\"Google Plus icon\" width=\"30\" height=\"30\"><span>" . __( 'Find us on', 'scout' ) . " Google+</span></a>";
										if( !empty( $fields['social']['youtube'] ) ) echo "<a href=\"" . $fields['social']['youtube'] . "\"><img src=\"$imagedir/icon_youtube.png\" alt=\"Youtube icon\" width=\"30\" height=\"30\"><span>" . __( 'Find us on', 'scout' ) . " YouTube</span></a>";
										if( !empty( $fields['social']['instagram'] ) ) echo "<a href=\"http://instagram.com/" . $fields['social']['instagram'] . "\"><img src=\"$imagedir/icon_instagram.png\" alt=\"Instagram icon\" width=\"30\" height=\"30\"><span>" . __( 'Find us on', 'scout' ) . " Instagram</span></a>";
										if( !empty( $fields['social']['twitter'] ) ) echo "<a href=\"http://twitter.com/" . $fields['social']['twitter'] . "\"><img src=\"$imagedir/icon_twitter.png\" alt=\"Twitter icon\" width=\"30\" height=\"30\"><span>" . __( 'Find us on', 'scout' ) . " Twitter</span></a>";
									echo "</div>";
								}
								if( !empty( $fields['rich_text_field'])) {
									echo "<div class=\"footer_rich_text_field footer_section\">";
										echo do_shortcode($fields['rich_text_field']);
									echo "</div>";
								}
							echo "</div><!-- end .footer_info -->";
						}
				?>
			</div><!-- .footer-holder -->
		</footer><!-- #footer -->
	</div><!-- #w1 -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>