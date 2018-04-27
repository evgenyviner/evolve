<?php

/*******************************************************
 * Template: content-page.php
 *******************************************************/

$evolve_edit_post  = evolve_get_option( 'evl_edit_post', '0' );
$evolve_share_this = evolve_get_option( 'evl_share_this', 'single' );
?>

    <div id="post-<?php the_ID(); ?>" class="<?php semantic_entries(); ?>">

		<?php
		if ( get_post_meta( $post->ID, 'evolve_page_title', true ) == 'no' ):
		else:
			?>

            <h1 class="entry-title"><?php
				if ( get_the_title() ) {
					the_title();
				}

				if ( $evolve_edit_post == "1" ) {
					if ( current_user_can( 'edit_post', $post->ID ) ):
						edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-page edit-attach">', '</span>' );
					endif;
				}
				?></h1>
		<?php
		endif;

		if ( has_post_thumbnail() ) {
			echo '<div class="thumbnail-post">';
			the_post_thumbnail( 'post-thumbnail' );
			echo '</div>';
		}
		?>

        <div class="entry-content article">

			<?php
			the_content();
			wp_link_pages();
			?>

            <div class="clearfix"></div>

        </div><!-- .entry-content .article -->

		<?php trackback_rdf(); ?>

    </div><!-- #post -->

<?php
if ( $evolve_share_this == 'all' ) {
	evolve_sharethis();
}

if ( ! is_front_page() ) {
	comments_template( '', true );
}