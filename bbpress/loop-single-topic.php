<?php
/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */
?>

<ul id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

    <li class="bbp-topic-title">

		<?php
		if ( bbp_is_user_home() ) :

			if ( bbp_is_favorites() ) :
				?>

                <span class="bbp-topic-action">

                    <?php
                    do_action( 'bbp_theme_before_topic_favorites_action' );

                    bbp_user_favorites_link( array( 'before' => '', 'favorite' => '+', 'favorited' => '&times;' ) );

                    do_action( 'bbp_theme_after_topic_favorites_action' );
                    ?>

                </span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

                <span class="bbp-topic-action">

                    <?php
                    do_action( 'bbp_theme_before_topic_subscription_action' );

                    bbp_user_subscribe_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) );

                    do_action( 'bbp_theme_after_topic_subscription_action' );
                    ?>

                </span>

			<?php
			endif;

		endif;

		do_action( 'bbp_theme_before_topic_title' );
		?>

        <a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>

		<?php
		do_action( 'bbp_theme_after_topic_title' );

		bbp_topic_pagination();

		do_action( 'bbp_theme_before_topic_meta' );
		?>

        <p class="bbp-topic-meta">

			<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>

            <span class="bbp-topic-started-by"><?php printf( __( 'Started by: %1$s', 'evolve' ), bbp_get_topic_author_link( array(
					'type' => 'name',
					'size' => '30'
				) ) ); ?></span>

			<?php
			do_action( 'bbp_theme_after_topic_started_by' );

			if ( ! bbp_is_single_forum() || ( bbp_get_topic_forum_id() !== bbp_get_forum_id() ) ) :

				do_action( 'bbp_theme_before_topic_started_in' );
				?>

                <span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'evolve' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>

				<?php
				do_action( 'bbp_theme_after_topic_started_in' );

			endif;
			?>

        </p>

		<?php
		do_action( 'bbp_theme_after_topic_meta' );

		bbp_topic_row_actions();
		?>

    </li>

    <li class="bbp-topic-voice-count"><?php bbp_topic_voice_count(); ?></li>

    <li class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></li>

    <li class="post-meta bbp-topic-freshness">

		<?php
		do_action( 'bbp_theme_before_topic_freshness_link' );

		bbp_topic_freshness_link();

		do_action( 'bbp_theme_after_topic_freshness_link' );
		?>

			<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

            <span class="bbp-topic-freshness-author"><?php bbp_author_link( array(
					'post_id' => bbp_get_topic_last_active_id(),
					'size'    => '30'
				) ); ?></span>

			<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>

    </li>
</ul><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
