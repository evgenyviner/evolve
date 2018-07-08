<?php
/**
 * New/Edit Reply
 *
 * @package bbPress
 * @subpackage Theme
 */
if ( bbp_is_reply_edit() ) : ?>

    <div class="bbpress-forums">

<?php endif;

if ( bbp_current_user_can_access_create_reply_form() ) : ?>

    <div id="new-reply-<?php bbp_topic_id(); ?>" class="bbp-reply-form">

        <form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>">

			<?php do_action( 'bbp_theme_before_reply_form' ); ?>

            <h3 id="reply-title">

				<?php printf( __( 'Reply to %s', 'evolve' ), bbp_get_topic_title() ); ?>

            </h3>

			<?php do_action( 'bbp_theme_before_reply_form_notices' ); ?>

            <div>

				<?php bbp_get_template_part( 'form', 'anonymous' );

				do_action( 'bbp_theme_before_reply_form_content' );

				bbp_the_content( array( 'context' => 'reply' ) );

				do_action( 'bbp_theme_after_reply_form_content' );

				if ( ! ( bbp_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

                    <p class="form-allowed-tags">
                        <label><?php esc_html_e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'evolve' ); ?></label><br/>
                        <code><?php bbp_allowed_tags(); ?></code>
                    </p>

				<?php
				endif;

				if ( bbp_allow_topic_tags() && current_user_can( 'assign_topic_tags' ) ) :

					do_action( 'bbp_theme_before_reply_form_tags' );
					?>

                    <p>
                        <label for="bbp_topic_tags"><?php esc_html_e( 'Tags:', 'evolve' ); ?></label><br/>
                        <input type="text" value="<?php bbp_form_topic_tags(); ?>"
                               tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_tags"
                               id="bbp_topic_tags" <?php disabled( bbp_is_topic_spam() ); ?> />
                    </p>

					<?php
					do_action( 'bbp_theme_after_reply_form_tags' );

				endif;

				if ( bbp_allow_revisions() && bbp_is_reply_edit() ) :

					do_action( 'bbp_theme_before_reply_form_revisions' );
					?>

                    <fieldset class="bbp-form">
                        <legend>
                            <input name="bbp_log_reply_edit" id="bbp_log_reply_edit" type="checkbox"
                                   value="1" <?php bbp_form_reply_log_edit(); ?>
                                   tabindex="<?php bbp_tab_index(); ?>"/>
                            <label for="bbp_log_reply_edit"><?php esc_html_e( 'Keep a log of this edit:', 'evolve' ); ?></label><br/>
                        </legend>

                        <div>
                            <label for="bbp_reply_edit_reason"><?php printf( __( 'Optional reason for editing:', 'evolve' ), bbp_get_current_user_name() ); ?></label><br/>
                            <input type="text" value="<?php bbp_form_reply_edit_reason(); ?>"
                                   tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_reply_edit_reason"
                                   id="bbp_reply_edit_reason"/>
                        </div>
                    </fieldset>

					<?php
					do_action( 'bbp_theme_after_reply_form_revisions' );

				endif;

				do_action( 'bbp_theme_before_reply_form_submit_wrapper' );
				?>

                <div class="bbp-submit-wrapper">

					<?php
					do_action( 'bbp_theme_before_reply_form_submit_button' );

					bbp_cancel_reply_to_link();
					?>

                    <button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_reply_submit"
                            name="bbp_reply_submit"
                            class="btn btn-sm"><?php esc_html_e( 'Submit', 'evolve' ); ?></button>

					<?php do_action( 'bbp_theme_after_reply_form_submit_button' ); ?>

                </div>

				<?php
				if ( bbp_is_subscriptions_active() && ! bbp_is_anonymous() && ( ! bbp_is_reply_edit() || ( bbp_is_reply_edit() && ! bbp_is_reply_anonymous() ) ) ) :

					do_action( 'bbp_theme_before_reply_form_subscription' );
					?>

                    <div class="notify">

                        <p>

                            <input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox"
                                   value="bbp_subscribe"<?php bbp_form_topic_subscribed(); ?>
                                   tabindex="<?php bbp_tab_index(); ?>"/>

							<?php if ( bbp_is_reply_edit() && ( bbp_get_reply_author_id() !== bbp_get_current_user_id() ) ) : ?>

                                <label for="bbp_topic_subscription"><?php esc_html_e( 'Notify the author of follow-up replies via email', 'evolve' ); ?></label>

							<?php else : ?>

                                <label for="bbp_topic_subscription"><?php esc_html_e( 'Notify me of follow-up replies via email', 'evolve' ); ?></label>

							<?php endif; ?>

                        </p>

                    </div>

					<?php do_action( 'bbp_theme_after_reply_form_subscription' );

				endif;

				do_action( 'bbp_theme_after_reply_form_submit_wrapper' ); ?>

            </div>

			<?php bbp_reply_form_fields(); ?>

			<?php do_action( 'bbp_theme_after_reply_form' ); ?>

        </form>
    </div>

<?php elseif ( bbp_is_topic_closed() ) : ?>

    <p class="alert alert-warning"
       role="alert"><?php printf( __( 'The topic <b>%s</b> is closed to new replies', 'evolve' ), bbp_get_topic_title() ); ?></p>

<?php elseif ( bbp_is_forum_closed( bbp_get_topic_forum_id() ) ) : ?>

    <p class="alert alert-warning"
       role="alert"><?php printf( __( 'The forum <b>%s</b> is closed to new topics and replies', 'evolve' ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></p>

<?php else : ?>

    <p class="alert alert-warning"
       role="alert"><?php is_user_logged_in() ? esc_html_e( 'You cannot reply to this topic', 'evolve' ) : esc_html_e( 'You must be logged in to reply to this topic.', 'evolve' ); ?></p>

<?php endif;

if ( bbp_is_reply_edit() ) : ?>

    </div>

<?php endif;
