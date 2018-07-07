<?php

/*
   Displays Error 404 Page
   ======================================= */

get_header(); ?>

    <div id="primary" class="col mb-5">

		<?php

		/*
            Hooked: evolve_breadcrumbs() - 10
            ======================================= */

        do_action( 'evolve_before_post_title' ); ?>

        <h1 class="display-4"><?php _e( 'Yay! 404 Not Found', 'evolve' ); ?></h1>

        <p class="lead"><?php _e( 'Sorry, but you are looking for something that isn\'t here or it\'s been moved. Try a search?', 'evolve' ); ?></p>

        <div class="search-full-width">

			<?php get_search_form(); ?>

        </div><!-- .search-full-width -->
    </div><!-- #primary -->

<?php get_footer();
