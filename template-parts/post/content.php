<?php global $authordata; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) {
		the_title( '<h1 class="post-title">', '</h1>' );
	} else {
		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" ) {
			$evolve_title = the_title( '', '', false );
			echo '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			evolve_truncate( intval( evolve_theme_mod( 'evl_posts_excerpt_title_length', '40' ) ), $evolve_title );
			echo '</a></h2>';
		} else {
			the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
	}

	if ( evolve_theme_mod( 'evl_header_meta', 'single_archive' ) == "single_archive" || ( evolve_theme_mod( 'evl_header_meta', 'single_archive' ) == "single" && is_single() ) ) { ?>

        <div class="row post-meta align-items-top">
            <div class="col author vcard">

				<?php if ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_theme_mod( 'evl_author_avatar', '0' ) == "1" ) {
					echo get_avatar( get_the_author_meta( 'email' ), '30' );
				}

				if ( ! is_single() ) { ?><a href="<?php the_permalink() ?>"><?php } ?>

                    <span class="published updated">

                        <?php the_time( get_option( 'date_format' ) ); ?>

                    </span>

					<?php if ( ! is_single() ) { ?></a><?php }

			esc_html_e( 'Written by', 'evolve' ); ?>

                <strong>

					<?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( sprintf( __( 'View all posts by %s', 'evolve' ), $authordata->display_name ) ) . '">' . get_the_author() . '</a>' ) ?>

                </strong>

				<?php if ( evolve_theme_mod( 'evl_edit_post', '0' ) == "1" ) {
					if ( current_user_can( 'edit_post', $post->ID ) ):
						edit_post_link( '', '<span class="btn btn-sm edit-post">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
					endif;
				} ?>

            </div><!-- .col .author .vcard -->

			<?php if ( ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" || is_single() ) && comments_open() ) : ?>

                <div class="col comment-count">

					<?php echo evolve_get_svg( 'comment' );
					comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?>

                </div><!-- .col .comment-count -->

			<?php endif; ?>

        </div><!-- .row .post-meta .align-items-top -->

	<?php } else {
		if ( evolve_theme_mod( 'evl_edit_post', '0' ) == "1" ) {
			if ( current_user_can( 'edit_post', $post->ID ) ):
				edit_post_link( '', '<span class="btn btn-sm edit-post edit-attach">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
			endif;
		}
	}

	if ( is_single() && evolve_theme_mod( 'evl_blog_featured_image', '0' ) == "1" && has_post_thumbnail() ) {
		echo '<div class="thumbnail-post-single">';
		the_post_thumbnail( 'post-thumbnail' );
		echo '</div>';
	} ?>

    <div class="post-content">

		<?php if ( ! is_single() && evolve_theme_mod( 'evl_featured_images', '1' ) == "1" ) {

			if ( has_post_thumbnail() ) {
				echo '<div class="thumbnail-post"><a href="';
				the_permalink();
				echo '">';
				the_post_thumbnail( 'post-thumbnail' );
				echo '<div class="mask"><div class="icon"></div></div></a></div>';
			} else {
				if ( evolve_get_first_image() ):
					echo '<div class="thumbnail-post"><a href="';
					the_permalink();
					echo '"><img src="' . evolve_get_first_image() . '" alt="';
					the_title();
					echo '" /><div class="mask"><div class="icon"></div></div>	</a></div>';
				else:
					if ( evolve_theme_mod( 'evl_thumbnail_default_images', '0' ) == 0 ) {
						echo '<div class="thumbnail-post"><a href="';
						the_permalink();
						echo '"><img src="' . get_template_directory_uri() . '/assets/images/no-thumbnail.jpg" alt="';
						the_title();
						echo '" /><div class="mask"><div class="icon"></div></div></a></div>';
					}
				endif;
			}
		}

		if ( ! is_single() && ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" || ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_theme_mod( 'evl_excerpt_thumbnail', '0' ) == "1" ) ) ) {

		the_excerpt(); ?>

    </div><!-- .post-content -->

<?php if ( ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" || evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_theme_mod( 'evl_excerpt_thumbnail', '0' ) == "1" ) && ( ( comments_open() || evolve_get_terms( 'tags' ) || evolve_get_terms( 'cats' ) ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" || evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) ) { ?>

    <div class="row post-meta post-meta-footer align-items-top">

		<?php if ( evolve_get_terms( 'cats' ) || evolve_get_terms( 'tags' ) ) { ?>

            <div class="col">

				<?php echo evolve_get_svg( 'category' ) . evolve_get_terms( 'cats' );
				if ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_get_terms( 'tags' ) ) {
					echo evolve_get_svg( 'tag' ) . evolve_get_terms( 'tags' );
				} ?>

            </div><!-- .col -->

		<?php }
		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && comments_open() ) { ?>

            <div class="col-md-6 comment-count">

				<?php echo evolve_get_svg( 'comment' );
				comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?>

            </div><!-- .col .comment-count -->

		<?php }
		if ( ( is_single() || evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" ) && ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" || evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) {
			echo '<div class="col-md-6"><div class="share-this">';
			evolve_sharethis();
			echo '</div></div><!-- .col .share-this -->';
		} ?>

    </div><!-- .row .post-meta .post-meta-footer .align-items-top -->

<?php } ?>

    <a class="btn btn-sm" href="<?php the_permalink(); ?>">

		<?php esc_html_e( 'Read More', 'evolve' ); ?>

    </a>

<?php } else {

	the_content( __( 'Read More &raquo;', 'evolve' ) );

	evolve_link_pages();

	?>

    </div><!-- .post-content -->

	<?php if ( ( ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" || is_single() ) && ( comments_open() || evolve_get_terms( 'cats' ) || evolve_get_terms( 'tags' ) || evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" || evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) ) { ?>

        <div class="row post-meta post-meta-footer align-items-top">

			<?php if ( evolve_get_terms( 'cats' ) || evolve_get_terms( 'tags' ) ) { ?>

                <div class="col">

					<?php echo evolve_get_svg( 'category' ) . evolve_get_terms( 'cats' );
					if ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_get_terms( 'tags' ) ) {
						echo evolve_get_svg( 'tag' ) . evolve_get_terms( 'tags' );
					} ?>

                </div><!-- .col -->

			<?php }
			if ( ( is_single() || evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" ) && ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" || evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) {
				echo '<div class="col-md-6"><div class="share-this">';
				evolve_sharethis();
				echo '</div></div><!-- .col .share-this -->';
			} ?>

        </div><!-- .row .post-meta .post-meta-footer .align-items-top -->

	<?php } ?>

<?php } ?>

</article><!-- .post -->

