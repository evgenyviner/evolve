<?php

/*
   Displays Comments
   ======================================= */

if ( post_password_required() ) {
	?>
    <p class="password-protected alert"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'evolve' ); ?></p>
	<?php
	return;
}
?>

    <div id="comments">
		<?php if ( have_comments() ) : // If comments exist for this entry, continue    ?>

			<?php if ( ! empty( $comments_by_type['comment'] ) ) : ?>
                <div class="comments-title-back"><?php evolve_discussion_title( 'comment' ); ?>
					<?php evolve_discussion_rss(); ?>

                    <div class="clearfix"></div>
                </div>
			<?php
			else : // this is displayed if there are no comments so far
				if ( comments_open() ) :
					// If comments are open, but there are no comments.
					echo '<div class="comments-title-back"><h3 class="comment-title"><span class="comment-title-meta no-comment">';
					esc_html_e( 'No Comments Yet', 'evolve' );
					echo '</span></h3>';
					echo evolve_discussion_rss();
					echo '<div class="clearfix"></div>';
					echo '</div>';
				else : // comments are closed
					//do nothing..
				endif;
			endif; // ( $comments_by_type['comment'] ) ?>

			<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
                <div class="comments-title-back pings-title"><?php evolve_discussion_title( 'pings' ); ?>

                    <div class="clearfix"></div>
                </div>
			<?php
			else :
			endif; // ( $comments_by_type['pings'] ) ?>

			<?php if ( ! empty( $comments_by_type['comment'] ) ) : ?>
                <!--BEGIN .comment-list-->
                <ol class="comment-list">
					<?php
					wp_list_comments( array(
						'callback'     => 'evolve_comments_callback',
						'end-callback' => 'evolve_comments_endcallback'
					) );
					?>
                    <!--END .comment-list-->
                </ol>
			<?php endif; ?>

			<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
                <!--BEGIN .pings-list-->
                <ol class="comment-list">
					<?php
					wp_list_comments( array(
						'type'         => 'pings',
						'callback'     => 'evolve_pings_callback',
						'end-callback' => 'evolve_pings_endcallback'
					) );
					?>
                    <!--END .pings-list-->
                </ol>
			<?php endif; ?>

            <div class="navigation row">
                <div class="col-sm-6 col-md-6 nav-next"><?php previous_comments_link( '<div class="btn btn-left icon-arrow-left icon-big">Older Comments</div>' ); ?></div>
                <div class="col-sm-6 col-md-6 nav-previous"><?php next_comments_link( '<div class="btn btn-right icon-arrow-right icon-big">Newer Comments</div>' ); ?></div>
            </div>

            <!--END #comments-->

		<?php
		endif;
		// ( have_comments() )
		?>
    </div>

<?php if ( comments_open() ) :

	$evolve_comments_args = array(
		'class_submit'  => 'btn',
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true"></textarea></p>',

	);
	comment_form( $evolve_comments_args );

endif;
