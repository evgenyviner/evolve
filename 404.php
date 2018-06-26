<?php

/*
   Displays Error 404 Page
   ======================================= */

get_header(); ?>

    <div id="primary" class="col mb-5">

		<?php evolve_breadcrumbs(); ?>

        <h1 class="display-4"><?php _e( 'Yay! 404 Not Found', 'evolve' ); ?></h1>

        <p class="lead"><?php _e( 'Sorry, but you are looking for something that isn\'t here or it\'s been moved. Try a search?', 'evolve' ); ?></p>

        <div class="error-not-found">

			<?php get_search_form(); ?>

        </div><!-- .error-not-found -->
    </div><!-- #primary -->

<?php get_footer();
