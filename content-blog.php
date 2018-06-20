<?php

global $authordata;
$evolve_first                      = 0;
$evolve_layout                     = evolve_theme_mod( 'evl_layout', '2cl' );
$evolve_post_layout                = evolve_theme_mod( 'evl_post_layout', 'two' );
$evolve_nav_links                  = evolve_theme_mod( 'evl_nav_links', 'after' );
$evolve_header_meta                = evolve_theme_mod( 'evl_header_meta', 'single_archive' );
$evolve_excerpt_thumbnail          = evolve_theme_mod( 'evl_excerpt_thumbnail', '0' );
$evolve_share_this                 = evolve_theme_mod( 'evl_share_this', 'single' );
$evolve_post_links                 = evolve_theme_mod( 'evl_post_links', 'after' );
$evolve_similar_posts              = evolve_theme_mod( 'evl_similar_posts', 'disable' );
$evolve_featured_images            = evolve_theme_mod( 'evl_featured_images', '1' );
$evolve_edit_post                  = evolve_theme_mod( 'evl_edit_post', '0' );
$evolve_breadcrumbs                = evolve_theme_mod( 'evl_breadcrumbs', '1' );
$evolve_posts_excerpt_title_length = intval( evolve_theme_mod( 'evl_posts_excerpt_title_length', '40' ) );
?>

<div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

	<?php
	if ( is_home() || is_front_page() ) {
		get_template_part( 'template-parts/front-page-builder/front-page-builder' );
	}

	if ( $evolve_breadcrumbs == "1" ):
		if ( is_home() || is_front_page() ) {

		} else {
			evolve_breadcrumb();
		}
	endif;

	?>
    <!-- 2 or 3 columns begin -->

	<?php
	if ( $evolve_post_layout == "two" || $evolve_post_layout == "three" ) {

		$temp     = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( 'posts_per_page=6' . '&paged=' . $paged );

		if ( ( $evolve_nav_links == "before" ) || ( $evolve_nav_links == "both" ) ) :
			?>
            <span class="nav-top">
                            <?php get_template_part( 'template-parts/navigation/navigation', 'index' ); ?>
                        </span>
		<?php
		endif;

		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$evolve_first ++;
			?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ( $evolve_header_meta == "" ) || ( $evolve_header_meta == "single_archive" ) ) : ?>

                    <h2 class="entry-title">
                        <a href="<?php the_permalink() ?>" rel="bookmark"
                           title="<?php esc_html_e( 'Permanent Link to ', 'evolve' ) . the_title(); ?>">
							<?php
							if ( get_the_title() ) {
								$title = the_title( '', '', false );
								echo evolve_truncate( $title, $evolve_posts_excerpt_title_length, '...' );
							}
							?>
                        </a>
                    </h2>

                       <div class="entry-meta">
                        <a href="<?php the_permalink() ?>"><span
                                    class="published updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>
                        <span class="author vcard">
                                        <?php esc_html_e( 'Written by', 'evolve' ); ?>
                            <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( sprintf( __( 'View all posts by %s', 'evolve' ), $authordata->display_name ) ) . '">' . get_the_author() . '</a>' ) ?></strong>
                                    </span>
						<?php
						if ( $evolve_edit_post == "1" ) {
							if ( current_user_can( 'edit_post', $post->ID ) ):
								edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post">', '</span>' );
							endif;
						}
						?>

                        <!-- .entry-meta -->
                    </div>

				<?php else: ?>

                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"
                           title="<?php esc_html_e( 'Permanent Link to', 'evolve' ); ?> <?php the_title(); ?>">
							<?php
							if ( get_the_title() ) {
								$title = the_title( '', '', false );
								echo evolve_truncate( $title, $evolve_posts_excerpt_title_length, '...' );
							}
							?>
                        </a>
                    </h2>

				<?php endif; //if (($evolve_header_meta == "")    ?>

                <div class="entry-content">

					<?php
					if ( $evolve_featured_images == "1" ) :

						if ( has_post_thumbnail() ) :
							?>

                            <div class="thumbnail-post">
                                <a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'post-thumbnail' ); ?>
                                    <div class="mask">
                                        <span class="icon"></span>
                                    </div>
                                </a>
                            </div>

						<?php
						else: $image = evolve_get_first_image();

							if ( $image ):
								?>

                                <div class="thumbnail-post">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>"
                                                                             alt="<?php the_title(); ?>"/>
                                        <div class="mask">
                                            <span class="icon"></span>
                                        </div>
                                    </a>
                                </div>

							<?php else: ?>

                                <div class="thumbnail-post">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/no-thumbnail.jpg'; ?>"
                                             alt="<?php the_title(); ?>"/>
                                        <div class="mask">
                                            <span class="icon"></span>
                                        </div>
                                    </a>
                                </div>

							<?php
							endif; //if ($image):

						endif; //if (has_post_thumbnail()) :

					endif; //if ($evolve_featured_images == "1"):

					echo evolve_excerpt_max_charlength( 350 );
					?>

                    <div class="entry-meta">

                        <a class="btn btn-sm"
                           href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'evolve' ); ?></a>

						<?php if ( comments_open() ) : ?>
                            <span class="comment-count"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></span>
						<?php endif; ?>

                    </div><!-- .entry-meta -->

                   </div><!-- .entry-content -->

                <!-- .hentry-->
            </div>

		<?php
		endwhile;
		?>

		<?php
		get_template_part( 'template-parts/navigation/navigation', 'index' );

		$wp_query = null;
		$wp_query = $temp;
		?>

        <!-- 2 or 3 columns end -->

        <!-- 1 column begin -->


		<?php
	} else {

		$temp                   = $wp_query;
		$wp_query               = null;
		$wp_query               = new WP_Query();
		$default_posts_per_page = get_option( 'posts_per_page', 6 );
		$wp_query->query( "posts_per_page=$default_posts_per_page&paged=$paged" );

		if ( ( $evolve_nav_links == "before" ) || ( $evolve_nav_links == "both" ) ) :
			?>
            <span class="nav-top">
                <?php get_template_part( 'template-parts/navigation/navigation', 'index' ); ?>
            </span>

		<?php
		endif;

		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			$evolve_first ++;
			?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php
				$evolve_header_meta = evolve_theme_mod( 'evl_header_meta', 'disable' );
				if ( ( $evolve_header_meta == "" ) || ( $evolve_header_meta == "single_archive" ) ) {
					?>

                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"
                           title="<?php esc_html_e( 'Permanent Link to', 'evolve' ); ?> <?php the_title(); ?>">
							<?php
							if ( get_the_title() ) {
								the_title();
							}
							?>
                        </a>
                    </h2>

                        <div class="entry-meta">
                        <a href="<?php the_permalink() ?>"><span
                                    class="published updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>

						<?php if ( comments_open() ) : ?>
                            <span class="comment-count">
                                            <a href="<?php comments_link(); ?>"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></a>
                                        </span>
						<?php endif; ?>

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
                        <!-- .entry-meta -->
                    </div>

				<?php } else { ?>

                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"
                           title="<?php esc_html_e( 'Permanent Link to', 'evolve' ); ?> <?php the_title(); ?>">
							<?php
							if ( get_the_title() ) {
								the_title();
							}
							?>
                        </a>
                    </h2>
					<?php
					if ( $evolve_edit_post == "1" ) {
						if ( current_user_can( 'edit_post', $post->ID ) ):
							edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' );
						endif;
					}
				}
				?>

                <div class="entry-content">

					<?php
					if ( $evolve_featured_images == "1" ) {

						if ( has_post_thumbnail() ) :
							?>

                            <div class="thumbnail-post">
                                <a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'post-thumbnail' ); ?>
                                    <div class="mask">
                                        <span class="icon"></span>
                                    </div>
                                </a>
                            </div>

						<?php
						else: $image = evolve_get_first_image();

							if ( $image ):
								?>

                                <div class="thumbnail-post">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>"
                                                                             alt="<?php the_title(); ?>"/>
                                        <div class="mask">
                                            <span class="icon"></span>
                                        </div>
                                    </a>
                                </div>

							<?php else: ?>

                                <div class="thumbnail-post">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/no-thumbnail.jpg'; ?>"
                                             alt="<?php the_title(); ?>"/>
                                        <div class="mask">
                                            <span class="icon"></span>
                                        </div>
                                    </a>
                                </div>

							<?php
							endif; //if ($image):

						endif; //if (has_post_thumbnail()) :
					}

					if ( ( $evolve_excerpt_thumbnail == "1" ) ) :

						the_excerpt();
						?>

                        <a class="btn btn-sm"
                           href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'evolve' ); ?></a>

					<?php
					else:

						the_content( __( 'Read More &raquo;', 'evolve' ) );

						wp_link_pages( array(
							'before' => '<div id="page-links"><p><strong>' . __( 'Pages', 'evolve' ) . ':</strong>',
							'after'  => '</p></div>'
						) );

					endif;
					?>

                    <!-- .entry-content -->
                 </div>

                <!--BEGIN .entry-meta -->
                <div class="entry-meta row">

                    <div class="col-md-6">
						<?php if ( evolve_get_terms( 'cats' ) ) { ?>
                            <div class="entry-categories"> <?php echo evolve_get_terms( 'cats' ); ?></div>
							<?php
						}
						if ( evolve_get_terms( 'tags' ) ) {
							?>
                            <div class="entry-tags"> <?php echo evolve_get_terms( 'tags' ); ?></div>
						<?php } ?>

                        <!-- .entry-meta -->
                    </div>

                    <div class="col-md-6">
						<?php
						if ( ( $evolve_share_this == "single_archive" ) || ( $evolve_share_this == "all" ) ) {
							evolve_sharethis();
						} else {
							?>
                            <div class="mb-4"></div>
						<?php } ?>
                    </div>
                </div>

                <!--END .hentry-->
            </div>

			<?php
			comments_template();
			?>

		<?php
		endwhile;

		if ( ( $evolve_nav_links == "" ) || ( $evolve_nav_links == "after" ) || ( $evolve_nav_links == "both" ) ) {

			get_template_part( 'template-parts/navigation/navigation', 'index' );
		} else {

		}

		$wp_query = null;
		$wp_query = $temp;
	}
	?>

    <!-- 1 column end -->

    <!--END #primary .hfeed-->
</div>
