<?php
/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */
?>

<div class="bbpress-forums">

	<?php bbp_forum_subscription_link();

	if ( bbp_allow_search() ) : ?>

        <div class="search-full-width">

			<?php bbp_get_template_part( 'form', 'search' ); ?>

        </div>

	<?php endif;

	do_action( 'bbp_template_before_forums_index' );

	if ( bbp_has_forums() ) :

		bbp_get_template_part( 'loop', 'forums' );

	else :

		bbp_get_template_part( 'feedback', 'no-forums' );

	endif;

	do_action( 'bbp_template_after_forums_index' ); ?>

</div>