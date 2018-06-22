<?php

/*
   Main Index To Display Content
   ======================================= */

get_header();

global $authordata;

$evolve_layout                     = evolve_theme_mod( 'evl_layout', '2cl' );
$evolve_post_layout                = evolve_theme_mod( 'evl_post_layout', 'two' );
$evolve_nav_links                  = evolve_theme_mod( 'evl_nav_links', 'after' );
$evolve_header_meta                = evolve_theme_mod( 'evl_header_meta', 'single_archive' );
$evolve_category_page_title        = evolve_theme_mod( 'evl_category_page_title', '1' );
$evolve_excerpt_thumbnail          = evolve_theme_mod( 'evl_excerpt_thumbnail', '0' );
$evolve_share_this                 = evolve_theme_mod( 'evl_share_this', 'single' );
$evolve_post_links                 = evolve_theme_mod( 'evl_post_links', 'after' );
$evolve_similar_posts              = evolve_theme_mod( 'evl_similar_posts', 'disable' );
$evolve_featured_images            = evolve_theme_mod( 'evl_featured_images', '1' );
$evolve_edit_post                  = evolve_theme_mod( 'evl_edit_post', '0' );
$evolve_thumbnail_default_images   = evolve_theme_mod( 'evl_thumbnail_default_images', '0' );
$evolve_posts_excerpt_title_length = intval( evolve_theme_mod( 'evl_posts_excerpt_title_length', '40' ) );
$evolve_blog_featured_image        = evolve_theme_mod( 'evl_blog_featured_image', '0' );
?>

<div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

<?php
if ( is_home() || is_front_page() ) {
	get_template_part( 'template-parts/front-page-builder/front-page-builder' );
}

if ( evolve_theme_mod( 'evl_breadcrumbs', '1' ) == "1" ):
	if ( is_home() || is_front_page() ):
    elseif ( ( is_single() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) || ( is_page() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) ):
	else: evolve_breadcrumb();
	endif;
endif;

if ( $evolve_nav_links == "before" || $evolve_nav_links == "both" ) {
	get_template_part( 'template-parts/navigation/navigation', 'index' );
}

if ( $evolve_post_layout != "one" && ( is_home() || is_page_template( 'blog-page.php' ) ) ) {
	echo '<div class="card-columns">';
}

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">

				<?php if ( get_the_title() ) {
					if ( $evolve_post_layout != "one" ) {
						$evolve_title = the_title( '', '', false );
						echo evolve_truncate( $evolve_posts_excerpt_title_length, $evolve_title );
					} else {
						the_title();
					}
				} ?>

            </a>
        </h2>

		<?php if ( ( $evolve_header_meta == "" ) || ( $evolve_header_meta == "single_archive" ) ) { ?>

        <div class="row post-meta align-items-top">
            <div class="col author vcard">

				<?php if ( $evolve_post_layout == "one" && evolve_theme_mod( 'evl_author_avatar', '0' ) == "1" ) {
					echo get_avatar( get_the_author_meta( 'email' ), '30' );
				} ?>

                <a href="<?php the_permalink() ?>">
                    <span class="published updated">

                        <?php the_time( get_option( 'date_format' ) ); ?>

                    </span>
                </a>

				<?php esc_html_e( 'Written by', 'evolve' ); ?>

                <strong>

					<?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( sprintf( __( 'View all posts by %s', 'evolve' ), $authordata->display_name ) ) . '">' . get_the_author() . '</a>' ) ?>

                </strong>

				<?php if ( $evolve_edit_post == "1" ) {
					if ( current_user_can( 'edit_post', $post->ID ) ):
						edit_post_link( '', '<span class="btn btn-sm edit-post">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
					endif;
				} ?>

            </div><!-- .col .author .vcard -->

			<?php if ( $evolve_post_layout == "one" && comments_open() ) : ?>

                <div class="col comment-count">

					<?php echo evolve_get_svg( 'comment' );
					comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?>

                </div><!-- .col .comment-count -->

			<?php endif; ?>

        </div><!-- .row .post-meta .align-items-top -->

	<?php } else {
		if ( $evolve_edit_post == "1" ) {
			if ( current_user_can( 'edit_post', $post->ID ) ):
				edit_post_link( '', '<span class="btn btn-sm edit-post edit-attach">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
			endif;
		}
	} ?>

        <div class="post-content">

		<?php if ( $evolve_featured_images == "1" ) {

		if ( has_post_thumbnail() ) {
			echo '<div class="thumbnail-post"><a href="';
			the_permalink();
			echo '">';
			the_post_thumbnail( 'post-thumbnail' );
			echo '<div class="mask"><div class="icon"></div></div></a></div>';
		} else {

			$evolve_image = evolve_get_first_image();

			if ( $evolve_image ):
				echo '<div class="thumbnail-post"><a href="';
				the_permalink();
				echo '"><img src="' . $evolve_image . '" alt="';
				the_title();
				echo '" /><div class="mask"><div class="icon"></div></div>	</a></div>';

			else:
				if ( $evolve_thumbnail_default_images == 0 ) {
					echo '<div class="thumbnail-post"><a href="';
					the_permalink();
					echo '"><img src="' . get_template_directory_uri() . '/assets/images/no-thumbnail.jpg" alt="';
					the_title();
					echo '" /><div class="mask"><div class="icon"></div></div></a></div>';
				}
			endif;
		}
	}

		if ( $evolve_post_layout != "one" || ( $evolve_post_layout == "one" && $evolve_excerpt_thumbnail == "1" ) ) {

			the_excerpt(); ?>

            </div><!-- .post-content -->

			<?php if ( $evolve_post_layout != "one" && comments_open() || evolve_get_terms( 'cats' ) || ( $evolve_post_layout == "one" && ( evolve_get_terms( 'tags' ) || $evolve_share_this == "single_archive" || $evolve_share_this == "all" ) ) ) { ?>

                <div class="row post-meta post-meta-footer align-items-top">

					<?php if ( evolve_get_terms( 'cats' ) || evolve_get_terms( 'tags' ) ) { ?>

                        <div class="col">

							<?php echo evolve_get_svg( 'category' ) . evolve_get_terms( 'cats' );
							if ( $evolve_post_layout == "one" && evolve_get_terms( 'tags' ) ) {
								echo evolve_get_svg( 'tag' ) . evolve_get_terms( 'tags' );
							} ?>

                        </div><!-- .col -->

					<?php }
					if ( $evolve_post_layout != "one" && comments_open() ) { ?>

                        <div class="col-md-6 comment-count">

							<?php echo evolve_get_svg( 'comment' );
							comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?>

                        </div><!-- .col .comment-count -->

					<?php }
					if ( $evolve_post_layout == "one" ) {

						if ( $evolve_share_this == "single_archive" || $evolve_share_this == "all" ) {
							echo '<div class="col-md-6"><div class="share-this">';
							evolve_sharethis();
							echo '</div></div><!-- .col .share-this -->';
						}
					} ?>

                </div><!-- .row .post-meta .post-meta-footer .align-items-top -->

			<?php } ?>

            <a class="btn btn-sm" href="<?php the_permalink(); ?>">

				<?php esc_html_e( 'Read More', 'evolve' ); ?>

            </a>

		<?php } else {

			the_content( __( 'Read More &raquo;', 'evolve' ) );

			wp_link_pages_args_prevnext_add();

			?>

            </div><!-- .post-content -->

		<?php } ?>

        </div><!-- .post -->

	<?php
	endwhile;

	if ( $evolve_post_layout != "one" && ( is_home() || is_page_template( 'blog-page.php' ) ) ) {
		echo '</div><!-- .card-columns -->';
	}

	if ( $evolve_nav_links == "after" || $evolve_nav_links == "both" ) {
		get_template_part( 'template-parts/navigation/navigation', 'index' );
	}

endif; ?>

    </div><!-- #primary -->

<?php
if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
