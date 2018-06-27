<?php

/*
   Displays Blog Pagination
   ======================================= */

?>

<nav aria-label="navigation"
     class="<?php if ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "number_pagination" || is_singular() ) {
	     echo 'row ';
     } ?>navigation mb-5">

	<?php if ( is_singular() && ! is_page() ) { ?>

        <div class="col-sm-6 nav-next"><?php next_post_link( '%link', '%title' ); ?></div>
        <div class="col-sm-6 nav-previous"><?php previous_post_link( '%link', '%title' ); ?></div>

	<?php } else {
		if ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) == "number_pagination" ) {
			evolve_number_pagination();
		} else { ?>

            <div class="col-sm-6 nav-next"><?php previous_posts_link( __( 'Newer Entries', 'evolve' ) ); ?></div>
            <div class="col-sm-6 nav-previous"><?php next_posts_link( __( 'Older Entries', 'evolve' ) ); ?></div>

		<?php }
	} ?>

</nav><!-- .row .navigation .mb-5 -->


