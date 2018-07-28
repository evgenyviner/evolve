<?php

/*
    Main Template For BuddyPress
    ======================================= */

get_header();

/*
    Hooked: evolve_primary_container() - 5
    ======================================= */

do_action( 'evolve_before_content_area' );

if ( have_posts() ): the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <span class="post-title" style="display: none;"><?php the_title(); ?></span>
        <span class="vcard" style="display: none;"><span
                    class="fn"><?php the_author_posts_link(); ?></span></span>
        <div class="post-content">
			<?php the_content();
			evolve_wp_link_pages(); ?>
        </div>
    </div>

<?php endif;

/*
	Hooked: evolve_primary_container_close() - 5
	======================================= */

do_action( 'evolve_after_content_area' );

wp_reset_query();

if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();