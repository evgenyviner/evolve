<?php

/*******************************************************
 * Template: 404.php
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
$evolve_thumbnail_default_images   = evolve_theme_mod( 'evl_thumbnail_default_images', '0' );
$evolve_posts_excerpt_title_length = intval( evolve_theme_mod( 'evl_posts_excerpt_title_length', '40' ) );
$evolve_blog_featured_image        = evolve_theme_mod( 'evl_blog_featured_image', '0' );
$evolve_breadcrumbs                = evolve_theme_mod( 'evl_breadcrumbs', '1' );
?>

    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

		<?php if ( $evolve_breadcrumbs == "1" ):
			if ( is_home() || is_front_page() ):
            elseif ( ( is_single() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) || ( is_page() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) ):
			else: evolve_breadcrumb();
			endif;
		endif; ?>

        <div id="post-0">
            <h1 class="entry-title"><?php esc_html_e( 'Not Found', 'evolve' ); ?></h1>
            <div class="entry-content">
                <p><?php esc_html_e( 'Sorry, but you are looking for something that isn\'t here.', 'evolve' ); ?></p>
                <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                    <input type="search" id="search-text" placeholder="<?php echo __( 'Search ...', 'evolve' ) ?>"
                           value="<?php echo esc_attr( get_search_query() ) ?>" name="s"
                           title="<?php echo __( 'Type and Hit Enter ...', 'evolve' ) ?>"/>
                </form>
            </div><!-- .entry-content -->
        </div><!-- #post-0 -->
    </div>  <!-- #primary .hfeed -->

<?php
if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
