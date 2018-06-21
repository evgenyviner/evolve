<?php

/*******************************************************
 * Template: Single.php
 *******************************************************/

get_header();

$evolve_xyz                        = 0;
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

    <!--BEGIN #primary .hfeed-->
    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

		<?php
		$evolve_breadcrumbs = evolve_theme_mod( 'evl_breadcrumbs', '1' );
		if ( $evolve_breadcrumbs == "1" ):
			if ( is_home() || is_front_page() ):
            elseif ( ( is_single() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) || ( is_page() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) ):
			else:evolve_breadcrumb();
			endif;
		endif;

		if ( have_posts() ) : while ( have_posts() ) : the_post();

			if ( ( $evolve_post_links == "before" ) || ( $evolve_post_links == "both" ) ) {
				?>
                <span class="nav-top">
                    <?php get_template_part( 'template-parts/navigation/navigation', 'index' ); ?>
                </span>
			<?php } ?>

            <!--BEGIN .hentry-->
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php
				if ( ( $evolve_header_meta == "" ) || ( $evolve_header_meta == "single" ) || ( $evolve_header_meta == "single_archive" ) ) {

					if ( get_post_meta( $post->ID, 'evolve_page_title', true ) == 'no' ):
					else:
						?>
                        <h1 class="post-title"><?php
							if ( get_the_title() ) {
								the_title();
							}
							if ( $evolve_edit_post == "1" ) {
								if ( current_user_can( 'edit_post', $post->ID ) ):
									edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' );
								endif;
							}
							?></h1>
					<?php endif; ?>

                    <div class="post-meta">

                        <a href="<?php the_permalink() ?>"><span
                                    class="published updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>

						<?php if ( comments_open() ) : ?>
                            <span class="comment-count"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></span>
						<?php
						else : // comments are closed
						endif;
						?>

                        <span class="author vcard">
                            <?php
                            $evolve_author_avatar = evolve_theme_mod( 'evl_author_avatar', '0' );
                            if ( $evolve_author_avatar == "1" ) {
	                            echo get_avatar( get_the_author_meta( 'email' ), '30' );
                            }

                            esc_html_e( 'Written by', 'evolve' );
                            ?>
                            <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( sprintf( __( 'View all posts by %s', 'evolve' ), $authordata->display_name ) ) . '">' . get_the_author() . '</a>' ) ?></strong>
                        </span>
						<?php
						if ( $evolve_edit_post == "1" ) {
							if ( current_user_can( 'edit_post', $post->ID ) ):
								edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post">', '</span>' );
							endif;
						}
						?>
                        <!-- .post-meta -->
                    </div>

					<?php
				} else {

					if ( get_post_meta( $post->ID, 'evolve_page_title', true ) == 'yes' ) :
						?>
                        <h1 class="post-title"><?php
							if ( get_the_title() ) {
								the_title();
							}
							if ( $evolve_edit_post == "1" ) {
								if ( current_user_can( 'edit_post', $post->ID ) ):
									edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' );
								endif;
							}
							?></h1>
					<?php
					endif;
				}

				if ( $evolve_blog_featured_image == "1" && has_post_thumbnail() ) {
					echo '<div class="thumbnail-post-single">';
					the_post_thumbnail( 'post-thumbnail' );
					echo '</div>';
				}
				?>

                <div class="post-content">

					<?php
					the_content( __( 'Read More &raquo;', 'evolve' ) );

					wp_link_pages( array(
						'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'evolve' ),
						'after'  => '</p></div>'
					) );
					?>

                    <div class="clearfix"></div>

                </div><!-- .post-content -->

                <div class="post-meta row">

                    <div class="col-md-6">
						<?php if ( evolve_get_terms( 'cats' ) ) { ?>
                            <div class="post-categories"> <?php echo evolve_get_terms( 'cats' ); ?></div>
							<?php
						}
						if ( evolve_get_terms( 'tags' ) ) {
							?>
                            <div class="post-tags"> <?php echo evolve_get_terms( 'tags' ); ?></div>
						<?php } ?>
                    </div>

                    <div class="col-md-6">
						<?php
						if ( ( $evolve_share_this == "" ) || ( $evolve_share_this == "single" ) || ( $evolve_share_this == "single_archive" ) || ( $evolve_share_this == "all" ) ) {
							evolve_sharethis();
						} else {
							?>
                            <div class="mb-4"></div>
						<?php } ?>
                    </div>

                </div><!-- .post-meta -->

                <!-- Auto Discovery Trackbacks
                <?php trackback_rdf(); ?>
                -->

                <!--END .hentry-->
            </div>

			<?php
			if ( ( $evolve_similar_posts == "" ) || ( $evolve_similar_posts == "disable" ) ) {

			} else {
				evolve_similar_posts();
			}

			if ( ( $evolve_post_links == "" ) || ( $evolve_post_links == "after" ) || ( $evolve_post_links == "both" ) ) {
				get_template_part( 'template-parts/navigation/navigation', 'index' );
			}

			comments_template( '', true );

		endwhile;
		endif;
		?>

        <!--END #primary .hfeed-->
    </div>

<?php
if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
