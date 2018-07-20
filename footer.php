<?php

/*
   Displays Footer
   ======================================= */

if ( ( ( is_front_page() ) && evolve_theme_mod( 'evl_front_elements_content_display', 'above' ) != 'above' ) || ! is_front_page() ) { ?>

    </div><!-- .row -->
    </div><!-- .container -->
    </div><!-- .content -->

<?php } ?>

<footer class="footer">
    <div class="container">

		<?php

		// Load The Footer Widgets If Enabled
		get_template_part( 'template-parts/footer/footer', 'widgets' );

		$evolve_footer_content = evolve_theme_mod( 'evl_footer_content', '<div id=\'copyright\'><span class=\'credits\'><a href=\'http://theme4press.com/evolve-multipurpose-wordpress-theme/\'>evolve</a> theme by Theme4Press&nbsp;&nbsp;&bull;&nbsp;&nbsp;Powered by <a href=\'http://wordpress.org\'>WordPress</a></span></div>' );
		if ( $evolve_footer_content === false ) {
			$evolve_footer_content = '';
		}
		echo '<div class="row"><div class="col custom-footer">' . do_shortcode( $evolve_footer_content ) . '</div></div>'; ?>

    </div><!-- .container -->
</footer><!-- .footer -->

<?php if ( evolve_theme_mod( 'evl_pos_button', 'right' ) !== "disable" ) { ?>

    <a href="#" id="backtotop" class="btn" role="button">&nbsp;</a>

<?php } ?>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
