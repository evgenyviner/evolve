<?php

/*
   Displays Page Content
   ======================================= */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

	if ( class_exists( 'bbPress' ) && ( bbp_is_reply_edit() || bbp_is_topic_edit() ) ) {
	} else {
		the_title( '<h1 class="post-title">', '</h1>' );
	}

	if ( evolve_theme_mod( 'evl_edit_post', '0' ) == "1" ) {
		if ( current_user_can( 'edit_post', $post->ID ) ):
			edit_post_link( '', '<span class="btn btn-sm edit-post">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
		endif;
	} ?>

    <div class="post-content">

		<?php the_content();
		evolve_link_pages(); ?>

    </div><!-- .post-content -->

</article><!-- #post -->