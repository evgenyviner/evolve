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

		evolve_custom_footer(); ?>

    </div><!-- .container -->
</footer><!-- .footer -->

<?php if ( evolve_theme_mod( 'evl_pos_button', 'right' ) !== "disable" ) { ?>

    <a href="#" id="backtotop" class="btn" role="button">&nbsp;</a>

<?php } ?>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
