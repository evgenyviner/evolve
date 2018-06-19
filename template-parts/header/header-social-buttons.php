<?php
$evolve_rss_feed   = evolve_theme_mod( 'evl_rss_feed', '' );
$evolve_newsletter = evolve_theme_mod( 'evl_newsletter', '' );
$evolve_facebook   = evolve_theme_mod( 'evl_facebook', '' );
$evolve_twitter_id = evolve_theme_mod( 'evl_twitter_id', '' );
$evolve_googleplus = evolve_theme_mod( 'evl_googleplus', '' );
$evolve_instagram  = evolve_theme_mod( 'evl_instagram', '' );
$evolve_skype      = evolve_theme_mod( 'evl_skype', '' );
$evolve_youtube    = evolve_theme_mod( 'evl_youtube', '' );
$evolve_flickr     = evolve_theme_mod( 'evl_flickr', '' );
$evolve_linkedin   = evolve_theme_mod( 'evl_linkedin', '' );
$evolve_pinterest  = evolve_theme_mod( 'evl_pinterest', '' );
$evolve_tumblr     = evolve_theme_mod( 'evl_tumblr', '' );
?>

<ul class="social-media-links ml-md-3 float-md-right">

	<?php if ( ! empty( $evolve_rss_feed ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_rss_feed; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'RSS Feed', 'evolve' ); ?>"><?php echo evolve_get_svg( 'rss' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_newsletter ) ) { ?>

        <li><a target="_blank" href="<?php if ( $evolve_newsletter != "" ) {
				echo $evolve_newsletter;
			} ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'Newsletter', 'evolve' ); ?>"><?php echo evolve_get_svg( 'email' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_facebook ) ) { ?>

        <li><a target="_blank" href="<?php echo esc_attr( $evolve_facebook ); ?>" data-toggle="tooltip"
               data-placement="bottom"
               title="<?php esc_html_e( 'Facebook', 'evolve' ); ?>"><?php echo evolve_get_svg( 'facebook' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_twitter_id ) ) { ?>

        <li><a target="_blank" href="<?php echo esc_attr( $evolve_twitter_id ); ?>" data-toggle="tooltip"
               data-placement="bottom"
               title="<?php esc_html_e( 'Twitter', 'evolve' ); ?>"><?php echo evolve_get_svg( 'twitter' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_googleplus ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_googleplus; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'Google Plus', 'evolve' ); ?>"><?php echo evolve_get_svg( 'google-plus' ); ?></a>
        </li>

	<?php }
	if ( ! empty( $evolve_instagram ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_instagram; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'Instagram', 'evolve' ); ?>"><?php echo evolve_get_svg( 'instagram' ); ?></a>
        </li>

	<?php }
	if ( ! empty( $evolve_skype ) ) { ?>

        <li><a href="skype:<?php echo $evolve_skype; ?>?call" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'Skype', 'evolve' ); ?>"><?php echo evolve_get_svg( 'skype' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_youtube ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_youtube; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'YouTube', 'evolve' ); ?>"><?php echo evolve_get_svg( 'youtube' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_flickr ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_flickr; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'Flickr', 'evolve' ); ?>"><?php echo evolve_get_svg( 'flickr' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_linkedin ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_linkedin; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'LinkedIn', 'evolve' ); ?>"><?php echo evolve_get_svg( 'linkedin' ); ?></a></li>

	<?php }
	if ( ! empty( $evolve_pinterest ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_pinterest; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'Pinterest', 'evolve' ); ?>"><?php echo evolve_get_svg( 'pinterest' ); ?></a>
        </li>

	<?php }
	if ( ! empty( $evolve_tumblr ) ) { ?>

        <li><a target="_blank" href="<?php echo $evolve_tumblr; ?>" data-toggle="tooltip" data-placement="bottom"
               title="<?php esc_html_e( 'Tumblr', 'evolve' ); ?>"><?php echo evolve_get_svg( 'tumblr' ); ?></a></li>

	<?php } ?>

</ul>