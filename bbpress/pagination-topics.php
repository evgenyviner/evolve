<?php
/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Theme
 */
do_action( 'bbp_template_before_pagination_loop' );
?>

    <div class="bbp-pagination">
        <div class="bbp-pagination-count">

			<?php bbp_forum_pagination_count(); ?>

        </div>
        <nav aria-label="navigation" class="navigation mb-5">

			<?php bbp_forum_pagination_links(); ?>

        </nav>
    </div>

<?php
do_action( 'bbp_template_after_pagination_loop' );
