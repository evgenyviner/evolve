<?php

/*
   Template: footer.php
   ======================================= */

?>
<!--END #content-->
</div>
<!--END .container-->
</div>
<!--END .content-->
</div>
<!--BEGIN .content-bottom-->
<div class="content-bottom">
    <!--END .content-bottom-->
</div>
<!--BEGIN .footer-->
<footer class="footer">
    <!--BEGIN .container-->
    <div class="container container-footer">

		<?php
		// if Footer widgets exist
		if ( ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) !== "" ) || ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) !== "disable" ) ) {

			$evolve_footer_css = '';
			if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "one" ) {
				$evolve_footer_css = 'widget-one-column col-sm-12';
			}
			if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "two" ) {
				$evolve_footer_css = 'col-sm-6 col-md-6';
			}
			if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "three" ) {
				$evolve_footer_css = 'col-sm-6 col-md-4';
			}
			if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "four" ) {
				$evolve_footer_css = 'col-sm-6 col-md-3';
			}
			?>

            <div class="footer-widgets">
                <div class="widgets-back-inside row">
                    <div class="<?php echo $evolve_footer_css; ?>">

						<?php
						if ( ! dynamic_sidebar( 'footer-1' ) ) :
						endif;
						?>

                    </div>
                    <div class="<?php echo $evolve_footer_css; ?>">

						<?php
						if ( ! dynamic_sidebar( 'footer-2' ) ) :
						endif;
						?>

                    </div>
                    <div class="<?php echo $evolve_footer_css; ?>">

						<?php
						if ( ! dynamic_sidebar( 'footer-3' ) ) :
						endif;
						?>

                    </div>
                    <div class="<?php echo $evolve_footer_css; ?>">

						<?php
						if ( ! dynamic_sidebar( 'footer-4' ) ) :
						endif;
						?>

                    </div>
                </div><!-- .widgets-back-inside .row -->
            </div><!-- .footer-widgets -->

		<?php } ?>

        <div class="clearfix"></div>

		<?php
		$footer_content = evolve_theme_mod( 'evl_footer_content', '<p id=\'copyright\'><span class=\'credits\'><a href=\'http://theme4press.com/evolve-multipurpose-wordpress-theme/\'>evolve</a> theme by Theme4Press&nbsp;&nbsp;&bull;&nbsp;&nbsp;Powered by <a href=\'http://wordpress.org\'>WordPress</a></span></p>' );
		if ( $footer_content === false ) {
			$footer_content = '';
		}
		echo do_shortcode( $footer_content );

		// Theme Hook
		evolve_footer_hooks(); ?>

    </div><!-- .container -->
</footer><!-- .footer -->

<?php if ( evolve_theme_mod( 'evl_pos_button', 'right' ) !== "disable" ) { ?>

    <a href="#top" id="top-link">
        <div id="backtotop"></div>
    </a>

<?php } ?>

</div><!-- #container-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
