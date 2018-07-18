<?php

/*
   Displays Blog Pagination
   ======================================= */

?>

<nav aria-label="navigation"
     class="<?php if ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "number_pagination" || ( is_single() && ! is_singular( array(
			     'page',
			     'attachment'
		     ) ) ) ) {
	     echo 'row ';

	     if ( ( class_exists( 'Woocommerce' ) && ! is_shop() ) || ! class_exists( 'Woocommerce' ) ) {
		     echo 'infinite ';
	     }
     } ?>navigation">

	<?php if ( is_single() && ! is_singular( array( 'page', 'attachment' ) ) ) { ?>

        <div class="col-sm-6 nav-next"><span class='screen-reader-text sr-only'><?php next_post_link( '%link', '%title' ); ?></span></div>
        <div class="col-sm-6 nav-previous"><span class='screen-reader-text sr-only'><?php previous_post_link( '%link', '%title' ); ?></span></div>

	<?php } else {
		if ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) == "number_pagination" ) {
			evolve_number_pagination();
		} else { ?>

            <div class="col-sm-6 nav-next"><span class='screen-reader-text sr-only'><?php previous_posts_link( __( 'Newer Entries', 'evolve' ) ); ?></span></div>
            <div class="col-sm-6 nav-previous"><span class='screen-reader-text sr-only'><?php next_posts_link( __( 'Older Entries', 'evolve' ) ); ?></span></div>

		<?php }
	} ?>

</nav><!-- .row .navigation -->


