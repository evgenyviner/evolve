<?php

/*
   Displays Blog Pagination
   ======================================= */

$evolve_pagination_type = evolve_theme_mod( 'evl_pagination_type', 'pagination' );

if ( is_singular() && ! is_page() ) { ?>

    <nav class="row navigation mb-5">
        <div class="col-sm-6 nav-previous"><?php previous_post_link( '%link', '%title' ); ?></div>
        <div class="col-sm-6 nav-next"><?php next_post_link( '%link', '%title' ); ?></div>
    </nav>

<?php } else { ?>

    <nav aria-label="navigation" class="<?php if ( $evolve_pagination_type != "number_pagination" ) {
		echo 'row ';
	} ?>navigation mb-5">

		<?php if ( $evolve_pagination_type == "number_pagination" ) {

			evolve_number_pagination();

		} else { ?>

            <div class="col-sm-6 nav-next"><?php previous_posts_link( __( 'Newer Entries', 'evolve' ) ); ?></div>
            <div class="col-sm-6 nav-previous"><?php next_posts_link( __( 'Older Entries', 'evolve' ) ); ?></div>

		<?php } ?>

    </nav>

<?php }
