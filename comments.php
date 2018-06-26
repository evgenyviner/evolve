<?php

/*
   Displays Comments
   ======================================= */

if ( post_password_required() ) {
	echo '<p class="alert alert-warning">' . __( 'This post is password protected. Enter the password to view comments.', 'evolve' ) . '</p>';

	return;
} ?>

    <div id="comments" class="row">

		<?php if ( have_comments() ) : ?>

            <div class="comments-title-back col-auto">

				<?php if ( ! empty( $comments_by_type['comment'] ) ) :

					evolve_discussion_title( 'comment' );
					evolve_discussion_rss();

				else :
					if ( comments_open() ) :
						// If comments are open, but there are no comments.
						echo '<h3 class="comment-title"><span class="comment-title-meta no-comment">';
						_e( 'No Comments Yet', 'evolve' );
						echo '</span></h3>';
						evolve_discussion_rss();
					endif;
				endif; ?>

            </div>

			<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>

                <div class="comments-title-back pings-title col"><?php evolve_discussion_title( 'pings' ); ?></div>

			<?php endif;

			if ( ! empty( $comments_by_type['comment'] ) ) : ?>

                <ol class="comment-list">

					<?php wp_list_comments( array(
						'callback'     => 'evolve_comments_callback',
						'end-callback' => 'evolve_comments_endcallback'
					) ); ?>

                </ol><!-- .comment-list -->

			<?php endif; ?>

            <div class="navigation row">
                <div class="col-md-6 nav-next"><?php previous_comments_link( '<div class="btn btn-left icon-arrow-left icon-big">Older Comments</div>' ); ?></div>
                <div class="col-md-6 nav-previous"><?php next_comments_link( '<div class="btn btn-right icon-arrow-right icon-big">Newer Comments</div>' ); ?></div>
            </div>

		<?php endif; ?>

    </div><!-- #comments -->

<?php if ( comments_open() ) :

	$evolve_comments_args = array(
		'class_submit'  => 'btn',
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true"></textarea></p>',

	);
	comment_form( $evolve_comments_args );

endif;
