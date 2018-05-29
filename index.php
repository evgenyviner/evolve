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
			else:evolve_breadcrumb();
			endif;
		endif;

		/*
		   2 / 3 Columns Begin
		   ======================================= */

		if ( $evolve_post_layout == "two" || $evolve_post_layout == "three" ) {

			if ( ( $evolve_nav_links == "before" ) || ( $evolve_nav_links == "both" ) ) { ?>

                <span class="nav-top">
                <?php get_template_part( 'template-parts/navigation/navigation', 'index' ); ?>
            </span>

			<?php }

			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

                    <div id="post-<?php the_ID(); ?>" class="<?php semantic_entries();
					evolve_post_class(); ?>">

						<?php if ( ( $evolve_header_meta == "" ) || ( $evolve_header_meta == "single_archive" ) ) { ?>

                            <h2 class="entry-title">
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                   title="Permanent Link to <?php the_title(); ?>">

									<?php if ( get_the_title() ) {
										$title = the_title( '', '', false );
										echo evolve_truncate( $title, $evolve_posts_excerpt_title_length, '...' );
									} ?>

                                </a>
                            </h2>

                            <div class="entry-meta entry-header">
                                <a href="<?php the_permalink() ?>"><span
                                            class="published updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>

                                <span class="author vcard">
                                            <?php esc_html_e( 'Written by', 'evolve' ); ?>
                                    <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( sprintf( __( 'View all posts by %s', 'evolve' ), $authordata->display_name ) ) . '">' . get_the_author() . '</a>' ) ?></strong>
                                        </span>

								<?php if ( $evolve_edit_post == "1" ) {
									if ( current_user_can( 'edit_post', $post->ID ) ):
										edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post">', '</span>' );
									endif;
								} ?>

                            </div><!-- .entry-meta .entry-header -->

						<?php } else { ?>

                            <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"
                                                       title="Permanent Link to <?php the_title(); ?>">

									<?php if ( get_the_title() ) {
										$title = the_title( '', '', false );
										echo evolve_truncate( $title, $evolve_posts_excerpt_title_length, '...' );
									} ?>

                                </a></h2>

							<?php if ( $evolve_edit_post == "1" ) {
								if ( current_user_can( 'edit_post', $post->ID ) ):
									edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' );
								endif;
							}
						} ?>

                        <div class="entry-content article">

							<?php if ( $evolve_featured_images == "1" ) {

								if ( has_post_thumbnail() ) {
									echo '<span class="thumbnail-post"><a href="';
									the_permalink();
									echo '">';
									the_post_thumbnail( 'post-thumbnail' );
									echo '
				<span class="mask">
				<span class="icon"></span>
				</span>
			</a></span>';
								} else {

									$image = evolve_get_first_image();

									if ( $image ):
										echo '<span class="thumbnail-post"><a href="';
										the_permalink();
										echo '"><img src="' . $image . '" alt="';
										the_title();
										echo '" />
				<span class="mask">
				<span class="icon"></span>
				</span>
				</a></span>';

									else:
										if ( $evolve_thumbnail_default_images == 0 ) {
											echo '<span class="thumbnail-post"><a href="';
											the_permalink();
											echo '"><img src="' . get_template_directory_uri() . '/assets/images/no-thumbnail.jpg" alt="';
											the_title();
											echo '" />
				<span class="mask">
				<span class="icon"></span>
				</span>
				</a></span>';
										}

									endif;
								}
							}

							the_excerpt(); ?>

                            <div class="clearfix"></div>
                        </div><!-- .entry-content .article -->

                        <div class="entry-meta entry-footer">

							<?php if ( evolve_get_terms( 'cats' ) ) { ?>
                                <div class="clearfix">
                                    <div class="entry-categories"><?php echo evolve_get_terms( 'cats' ); ?></div>
                                </div>

							<?php } ?>

                            <a class="btn btn-sm"
                               href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'evolve' ); ?></a>

							<?php if ( comments_open() ) : ?>
                                <span class="comment-count"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></span>
							<?php endif; ?>

                        </div>
                    </div><!-- #post -->

				<?php endwhile;

				get_template_part( 'template-parts/navigation/navigation', 'index' );

			endif;

			/*
			   2 / 3 Columns End
			   ======================================= */

			/*
			   1 Column Begin
			   ======================================= */

		} else {

			if ( ( $evolve_nav_links == "before" ) || ( $evolve_nav_links == "both" ) ) { ?>

                <span class="nav-top">
                <?php get_template_part( 'template-parts/navigation/navigation', 'index' ); ?>
            </span>

			<?php }
			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

                    <div id="post-<?php the_ID(); ?>"
                         class="<?php semantic_entries(); ?> <?php evolve_post_class_2(); ?>">

						<?php if ( ( $evolve_header_meta == "" ) || ( $evolve_header_meta == "single_archive" ) ) { ?>

                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"
                                                       title="Permanent Link to <?php the_title(); ?>"><?php
									if ( get_the_title() ) {
										the_title();
									}
									?>

                                </a>
                            </h2>

                            <div class="entry-meta entry-header">
                                <a href="<?php the_permalink() ?>"><span
                                            class="published updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>

								<?php if ( comments_open() ) : ?>

                                    <span class="comment-count"><a href="<?php comments_link(); ?>">
                                                    <?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></a>
                                            </span>

								<?php endif; ?>

                                <span class="author vcard">

                                            <?php $evolve_author_avatar = evolve_theme_mod( 'evl_author_avatar', '0' );
                                            if ( $evolve_author_avatar == "1" ) {
	                                            echo get_avatar( get_the_author_meta( 'email' ), '30' );
                                            }

                                            esc_html_e( 'Written by', 'evolve' ); ?>

                                    <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( sprintf( __( 'View all posts by %s', 'evolve' ), $authordata->display_name ) ) . '">' . get_the_author() . '</a>' ) ?></strong></span>

								<?php if ( $evolve_edit_post == "1" ) {
									if ( current_user_can( 'edit_post', $post->ID ) ):
										edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post">', '</span>' );
									endif;
								} ?>

                            </div><!-- .entry-meta .entry-header -->

						<?php } else { ?>

                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"
                                                       title="Permanent Link to <?php the_title(); ?>"><?php
									if ( get_the_title() ) {
										the_title();
									}
									?></a></h2>

							<?php if ( $evolve_edit_post == "1" ) {
								if ( current_user_can( 'edit_post', $post->ID ) ):
									edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' );
								endif;
							}
						} ?>

                        <div class="entry-content article">

							<?php if ( $evolve_featured_images == "1" ) {

								if ( has_post_thumbnail() ) {
									echo '<span class="thumbnail-post"><a href="';
									the_permalink();
									echo '">';
									the_post_thumbnail( 'post-thumbnail' );
									echo '
				<span class="mask">
				<span class="icon"></span>
				</span>
				</a></span>';
								} else {

									$image = evolve_get_first_image();

									if ( $image ):
										echo '<span class="thumbnail-post"><a href="';
										the_permalink();
										echo '"><img src="' . $image . '" alt="';
										the_title();
										echo '" />
				<span class="mask">
				<span class="icon"></span>
				</span>
				</a></span>';

									else:
										if ( $evolve_thumbnail_default_images == 0 ) {
											echo '<span class="thumbnail-post"><a href="';
											the_permalink();
											echo '"><img src="' . get_template_directory_uri() . '/assets/images/no-thumbnail.jpg" alt="';
											the_title();
											echo '" />
				<span class="mask">
				<span class="icon"></span>
				</span>
				</a></span>';
										}

									endif;
								}
							}

							if ( ( $evolve_excerpt_thumbnail == "1" ) ) {

								the_excerpt();
								?>

                                <a class="btn btn-sm"
                                   href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'evolve' ); ?></a>

								<?php
							} else {

								the_content( __( 'Read More &raquo;', 'evolve' ) );

								wp_link_pages( array(
									'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'evolve' ),
									'after'  => '</p></div>'
								) );
							} ?>

                            <div class="clearfix"></div>
                        </div><!-- .entry-content .article -->

                        <div class="entry-meta entry-footer row">
                            <div class="col-md-6">

								<?php if ( evolve_get_terms( 'cats' ) ) { ?>

                                    <div class="entry-categories"> <?php echo evolve_get_terms( 'cats' ); ?></div>

								<?php }

								if ( evolve_get_terms( 'tags' ) ) { ?>

                                    <div class="entry-tags"> <?php echo evolve_get_terms( 'tags' ); ?></div>

								<?php } ?>

                            </div><!-- .entry-meta .entry-footer -->

                            <div class="col-md-6">

								<?php if ( ( $evolve_share_this == "single_archive" ) || ( $evolve_share_this == "all" ) ) {
									evolve_sharethis();
								} else { ?>

                                    <div class="margin-40"></div>

								<?php } ?>

                            </div>
                        </div><!-- .entry-meta .entry-footer -->
                    </div><!-- #post -->

					<?php comments_template();

				endwhile;

				if ( ( $evolve_nav_links == "" ) || ( $evolve_nav_links == "after" ) || ( $evolve_nav_links == "both" ) ) {

					get_template_part( 'template-parts/navigation/navigation', 'index' );
				}

			endif;
		}

		/*
		   1 Column End
		   ======================================= */

		?>

    </div><!-- #primary -->

<?php

if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
