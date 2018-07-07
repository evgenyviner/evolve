<?php
/**
 * Search Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */
?>

<div id="bbpress-forums">

    <div class="search-page-search-form">
        <h2><?php esc_html_e( 'Need a new search?', 'evolve' ); ?></h2>
        <p><?php esc_html_e( 'If you didn\'t find what you were looking for, try a new search!', 'evolve' ); ?></p>

        <div class="search-full-width">

			<?php bbp_get_template_part( 'form', 'search' ); ?>

        </div>

    </div>

	<?php
	bbp_set_query_name( 'bbp_search' );

	do_action( 'bbp_template_before_search' );

	if ( bbp_has_search_results() ) :

		bbp_get_template_part( 'pagination', 'search' );

		bbp_get_template_part( 'loop', 'search' );

		bbp_get_template_part( 'pagination', 'search' );

    elseif ( bbp_get_search_terms() ) :

		bbp_get_template_part( 'feedback', 'no-search' );

	else :

	endif;

	do_action( 'bbp_template_after_search_results' );
	?>
</div>