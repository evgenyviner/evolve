<?php

/*
   Custom Definitions For Comments
   ======================================= */

/*
   Display Title And Count Based On Comment Type
   ======================================= */

function evolve_discussion_title( $type = null, $echo = true ) {
	if ( ! $type && empty( get_comments_number() ) ) {
		return;
	}

	$discussion_title = '';

	$comment_count = get_comments(
		array(
			'post_id' => get_the_ID(),
			'type'    => 'comment',
			'count'   => true
		)
	);
	$ping_count    = get_comments(
		array(
			'post_id' => get_the_ID(),
			'type'    => 'pingback',
			'count'   => true
		)
	);

	switch ( $type ) {
		case 'comment' :
			$count = $comment_count;
			$many  = apply_filters( 'evolve_many_comments', __( '% Comments', 'evolve' ) );
			$none  = apply_filters( 'evolve_no_comments', __( 'No Comments Yet', 'evolve' ) );
			$one   = apply_filters( 'evolve_one_comment', __( '1 Comment', 'evolve' ) );
			break;
		case 'pings' :
			$count = $ping_count;
			$many  = apply_filters( 'evolve_many_pings', __( '% Pings/Trackbacks', 'evolve' ) );
			$none  = '';
			$one   = apply_filters( 'evolve_one_ping', __( '1 Ping/Trackback', 'evolve' ) );
			break;
	}

	if ( $count > 1 ) {
		$number = str_replace( '%', number_format_i18n( $count ), $many );
	} elseif ( $count == 1 ) {
		$number = $one;
	} else {
		if ( $type = 'comment' ) {
			$number = $none;
		}
	}

	$tag = apply_filters( 'evolve_discussion_title_tag', (string) 'h3' );

	if ( $number ) {
		$discussion_title = '<' . $tag . ' class="' . $type . '-title mb-0">';
		$discussion_title .= $number;
		$discussion_title .= '</' . $tag . '>';
	}
	$evolve_discussion_title = apply_filters( 'evolve_discussion_title', (string) $discussion_title );

	return ( $echo ) ? print( $evolve_discussion_title ) : $evolve_discussion_title;
}

/*
   Comments Feed Link
   ======================================= */

function evolve_discussion_rss() {
	global $id;
	$uri  = get_post_comments_feed_link( $id );
	$text = '<div class="col-auto pl-sm-0"><a title="' . __( 'Follow replies', 'evolve' ) . '" class="comment-feed" data-toggle="tooltip" data-placement="top" href="' . $uri . '">' . evolve_get_svg( 'rss' ) . '</a></div>';
	echo $text;
}

/*
   Custom Comment Navigation
   ======================================= */

function evolve_comment_navigation() {
	$pages = paginate_comments_links( array(
		'echo'      => false,
		'type'      => 'array',
		'prev_text' => __( 'Previous Page', 'evolve' ),
		'next_text' => __( 'Next Page', 'evolve' )
	) );

	if ( ! is_array( $pages ) ) {
		return;
	}

	$output = '';
	foreach ( $pages as $page ) {
		$page   = "\n<li class='page-item'>$page</li>\n";
		$page   = str_replace( [ 'page-numbers' ], [ 'page-link' ], $page );
		$output .= $page;
	}

	echo '<nav aria-label="navigation" class="navigation mb-5"><ul class="pagination justify-content-center">' . $output . '</ul></nav>';
}

/*
   Default Comment Structure
   ======================================= */

function evolve_comments_callback( $comment, $args, $depth ) {
	global $post;

	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	} ?>

    <<?php echo $tag . ' ';
	comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment -<?php comment_ID() ?>"><?php
	if ( 'div' != $args['style'] ) { ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">

	<?php } ?>

    <div class="row align-items-center">
    <div class="col-xl-auto comment-author vcard">
        <b class="fn">

			<?php printf( __( '%s', 'evolve' ), get_comment_author_link() );
			echo ( $comment->user_id === $post->post_author ) ? '<span class="badge badge-pill badge-primary"> ' . __( 'Author', 'evolve' ) . '</span>' : '';
			echo ( get_comment_type() === "pingback" ) ? '<span class="badge badge-pill badge-secondary"> ' . __( 'Pingback', 'evolve' ) . '</span>' : ''; ?>

        </b>
    </div>
    <div class="col-auto comment-meta">
        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">

			<?php printf( __( '%1$s - %2$s', 'evolve' ), get_comment_date(), get_comment_time() ); ?>

        </a>
    </div>

	<?php edit_comment_link( '', '<div class="col-auto pl-sm-0"><span class="btn btn-sm edit-comment">' . evolve_get_svg( 'pencil' ) . '', '</span></div>' );

	if ( $args['avatar_size'] != 0 ) {
		echo '<div class="col">' . get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'rounded-circle' ) ) . '</div>';
	}

	echo '</div><!-- .row .align-items-center -->'; ?>

    <div class="comment-content">

		<?php if ( $comment->comment_approved == '0' ) { ?>

            <div class="alert alert-warning" role="alert">

				<?php _e( 'Your comment is awaiting moderation', 'evolve' ); ?>

            </div>

		<?php }

		comment_text(); ?>

    </div><!-- .comment-content -->

	<?php comment_reply_link(
		array_merge(
			$args,
			array(
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth']
			)
		)
	);

	if ( 'div' != $args['style'] ) :

		echo '</div>';

	endif;
}

/*
   Respond Form Fields
   ======================================= */

function evolve_comment_form_fields() {

	$evolve_commenter = wp_get_current_commenter();
	$evolve_req       = get_option( 'require_name_email' );
	$evolve_aria_req  = ( $evolve_req ? " aria-required='true'" : '' );

	$fields = array(
		'author'  =>
			'<p class="comment-form-author"><label for="author">' . __( 'Name', 'evolve' ) .
			( $evolve_req ? '<span class="required">*</span>' : '' ) . '</label>' .
			'<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $evolve_commenter['comment_author'] ) .
			'" size="30" ' . $evolve_aria_req . ' /></p>',
		'email'   =>
			'<p class="comment-form-email"><label for="email">' . __( 'Email', 'evolve' ) .
			( $evolve_req ? '<span class="required">*</span>' : '' ) . '</label>' .
			'<input id="email" name="email" class="form-control" type="text" value="' . esc_attr( $evolve_commenter['comment_author_email'] ) .
			'" size="30" ' . $evolve_aria_req . ' /></p>',
		'url'     =>
			'<p class="comment-form-url"><label for="url">' . __( 'Website', 'evolve' ) . '</label>' .
			'<input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $evolve_commenter['comment_author_url'] ) .
			'" size="30" /></p>',
		'cookies' =>
			'<p class="comment-form-cookies-consent custom-control custom-checkbox">' .
			'<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="custom-control-input" type="checkbox" value="yes" /><label for="wp-comment-cookies-consent"  class="custom-control-label">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'evolve' ) . '</label></p>',
	);

	return $fields;
}

add_filter( 'comment_form_default_fields', 'evolve_comment_form_fields' );

/*
   Comment Edit Link
   ======================================= */

function evolve_comment_edit() {
	edit_comment_link( '', '<span class="btn btn-sm edit-post">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
}

/*
   Add Button Class To The Comment Reply Link
   ======================================= */

function evolve_replace_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='comment-reply-link btn btn-sm", $class );

	return $class;
}

add_filter( 'comment_reply_link', 'evolve_replace_reply_link_class' );

/*
   Add Close Icon To The Cancel Reply Link
   ======================================= */

function evolve_cancel_reply_link( $formatted_link, $link, $text ) {
	$formatted_link = str_ireplace( $text, evolve_get_svg( 'close' ) . __( 'Cancel reply', 'evolve' ), $formatted_link );

	return $formatted_link;
}

add_filter( 'cancel_comment_reply_link', 'evolve_cancel_reply_link', 10, 3 );

/*
   Custom Post Password Form
   ======================================= */

function evolve_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<form class="form-inline my-5" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p class="display-4">' . __( "To view this protected post, enter the password below", "evolve" ) . '</p>
    <div class="form-group mb-3"><label class="lead" for="' . $label . '">' . __( "Password:", "evolve" ) . '</label></div><div class="form-group mx-sm-3 mb-3"><input class="form-control" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /></div><input class="btn btn-sm" type="submit" name="Submit" value="' . esc_attr__( "Submit", "evolve" ) . '" />
    </form>
    ';

	return $o;
}

add_filter( 'the_password_form', 'evolve_password_form' );