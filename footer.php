<?php

/*
   Displays Footer
   ======================================= */

?>

</div><!-- .row -->
</div><!-- .container -->
</div><!-- .content -->

<footer class="footer">
    <div class="container">

		<?php

		// Load The Footer Widgets If Enabled
		get_template_part( 'template-parts/footer/footer', 'widgets' );

		$footer_content = evolve_theme_mod( 'evl_footer_content', '<div id=\'copyright\'><span class=\'credits\'><a href=\'http://theme4press.com/evolve-multipurpose-wordpress-theme/\'>evolve</a> theme by Theme4Press&nbsp;&nbsp;&bull;&nbsp;&nbsp;Powered by <a href=\'http://wordpress.org\'>WordPress</a></span></div>' );
		if ( $footer_content === false ) {
			$footer_content = '';
		}
		echo '<div class="row"><div class="col">' . do_shortcode( $footer_content ) . '</div></div>';

		// Theme Hook
		evolve_footer_hooks(); ?>

    </div><!-- .container -->
</footer><!-- .footer -->

<?php if ( evolve_theme_mod( 'evl_pos_button', 'right' ) !== "disable" ) { ?>

    <a href="#" id="backtotop" class="btn" role="button">&nbsp;</a>

<?php } ?>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
