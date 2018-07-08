<?php
/**
 * Single Topic Lead Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */
do_action( 'bbp_template_before_lead_topic' ); ?>

    <ul id="bbp-topic-<?php bbp_topic_id(); ?>-lead" class="bbp-forums bbp-lead-topic">
        <li class="row bbp-header">
            <div class="col bbp-topic-title">

				<?php bbp_topic_author_link( array( 'type' => '', 'show_role' => true ) );

				if ( bbp_is_user_keymaster() ) :

					do_action( 'bbp_theme_before_topic_author_admin_details' );

					echo '&nbsp;&nbsp;';
					bbp_author_ip( bbp_get_topic_id() );

					do_action( 'bbp_theme_after_topic_author_admin_details' );

				endif; ?>

            </div><!-- .bbp-topic-title -->
            <div class="col post-meta m-0 text-right bbp-topic-content">

				<?php bbp_user_subscribe_link( array(
					'before'      => ' ',
					'subscribe'   => evolve_get_svg( 'rss' ) . esc_html__( 'Subscribe', 'evolve' ),
					'unsubscribe' => evolve_get_svg( 'ok' ) . esc_html__( 'Subscribed', 'evolve' )
				) );

				bbp_user_favorites_link( array(
					'before'    => '<span class="ml-3">',
					'after'     => '</span>',
					'favorite'  => evolve_get_svg( 'heart' ) . esc_html__( 'Favorite', 'evolve' ),
					'favorited' => evolve_get_svg( 'ok' ) . esc_html__( 'Favorited', 'evolve' )
				) ); ?>

            </div><!-- .bbp-topic-content -->
        </li><!-- .bbp-header -->

        <li class="bbp-body">
            <div id="post-<?php bbp_topic_id(); ?>" <?php bbp_topic_class( '', array( 'topic-lead' ) ); ?>>

                <div class="row align-items-center">
                    <div class="col-xl-auto comment-author vcard">

						<?php do_action( 'bbp_theme_before_topic_author_details' );

						echo '<span class="fn">';
						bbp_topic_author_link( array( 'type' => 'name', 'show_role' => false ) );
						echo '</span>';

						do_action( 'bbp_theme_after_topic_author_details' ); ?>

                    </div>
                    <div class="col-auto comment-meta">

						<?php bbp_topic_post_date(); ?>

                        <a href="<?php bbp_topic_permalink(); ?>"
                           class="bbp-topic-permalink mx-2">#<?php bbp_topic_id(); ?></a>

						<?php if ( bbp_is_topic_sticky() ) {
							echo ' ' . evolve_get_svg( 'pin' );
						} ?>

                    </div>
                    <div class="col">

						<?php bbp_topic_author_link( array(
							'size'      => '60',
							'type'      => 'avatar',
							'show_role' => false
						) ); ?>

                    </div>
                </div>
                <div class="bbp-topic-content">

					<?php do_action( 'bbp_theme_before_topic_content' );

					bbp_topic_content();

					do_action( 'bbp_theme_after_topic_content' ); ?>

                </div><!-- .bbp-topic-content -->
                <div class="post-meta m-0 mt-4 bbp-meta">

					<?php do_action( 'bbp_theme_before_topic_admin_links' );

					bbp_topic_admin_links( array( 'sep' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ) );

					do_action( 'bbp_theme_after_topic_admin_links' ); ?>

                </div><!-- .bbp-meta -->
            </div><!-- #post-<?php bbp_topic_id(); ?> -->
        </li><!-- .bbp-body -->
    </ul><!-- #bbp-topic-<?php bbp_topic_id(); ?>-lead -->

<?php do_action( 'bbp_template_after_lead_topic' );
