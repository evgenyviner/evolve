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

<ul class="sc_menu">
	<?php
	if ( ! empty( $evolve_rss_feed ) ) { ?>
        <li><a target="_blank" href="<?php echo $evolve_rss_feed; ?>" data-toggle="tooltip" data-placement="bottom" id="rss"
               title="<?php _e( 'RSS Feed', 'evolve' ); ?>"><i class="t4p-icon-social-rss"></i></a></li>
		<?php
	}

	if ( ! empty( $evolve_newsletter ) ) {
		?>
        <li><a target="_blank" href="<?php if ( $evolve_newsletter != "" ) {
				echo $evolve_newsletter;
			} ?>" data-toggle="tooltip" data-placement="bottom" id="email-newsletter" title="<?php _e( 'Newsletter', 'evolve' ); ?>"><i
                        class="t4p-icon-social-envelope-o"></i></a></li>
		<?php
	}

	if ( ! empty( $evolve_facebook ) ) {
		?>
        <li><a target="_blank" href="<?php echo esc_attr( $evolve_facebook ); ?>" data-toggle="tooltip" data-placement="bottom" id="facebook"
               title="<?php _e( 'Facebook', 'evolve' ); ?>"><i class="t4p-icon-social-facebook"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_twitter_id ) ) {
		?>
        <li><a target="_blank" href="<?php echo esc_attr( $evolve_twitter_id ); ?>" data-toggle="tooltip" data-placement="bottom" id="twitter"
               title="<?php _e( 'Twitter', 'evolve' ); ?>"><i class="t4p-icon-social-twitter"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_googleplus ) ) {
		?>
        <li><a target="_blank" href="<?php echo $evolve_googleplus; ?>" data-toggle="tooltip" data-placement="bottom" id="plus"
               title="<?php _e( 'Google Plus', 'evolve' ); ?>"><i class="t4p-icon-social-google-plus"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_instagram ) ) {
		?>
        <li><a target="_blank" href="<?php echo $evolve_instagram; ?>" data-toggle="tooltip" data-placement="bottom" id="instagram"
               title="<?php _e( 'Instagram', 'evolve' ); ?>"><i class="t4p-icon-social-instagram"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_skype ) ) {
		?>
        <li><a href="skype:<?php echo $evolve_skype; ?>?call" data-toggle="tooltip" data-placement="bottom" id="skype"
               title="<?php _e( 'Skype', 'evolve' ); ?>"><i class="t4p-icon-social-skype"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_youtube ) ) {
		?>
        <li><a target="_blank" href="<?php echo $evolve_youtube; ?>" data-toggle="tooltip" data-placement="bottom" id="youtube"
               title="<?php _e( 'YouTube', 'evolve' ); ?>"><i class="t4p-icon-social-youtube"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_flickr ) ) {
		?>
        <li><a target="_blank" href="<?php echo $evolve_flickr; ?>" data-toggle="tooltip" data-placement="bottom" id="flickr"
               title="<?php _e( 'Flickr', 'evolve' ); ?>"><i class="t4p-icon-social-flickr"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_linkedin ) ) {
		?>
        <li><a target="_blank" href="<?php echo $evolve_linkedin; ?>" data-toggle="tooltip" data-placement="bottom" id="linkedin"
               title="<?php _e( 'LinkedIn', 'evolve' ); ?>"><i class="t4p-icon-social-linkedin"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_pinterest ) ) {
		?>
        <li><a target="_blank" href="<?php echo $evolve_pinterest; ?>" data-toggle="tooltip" data-placement="bottom" id="pinterest"
               title="<?php _e( 'Pinterest', 'evolve' ); ?>"><i class="t4p-icon-social-pinterest"></i></a></li>
		<?php
	}
	if ( ! empty( $evolve_tumblr ) ) {
		?>
        <li><a target="_blank" href="<?php echo $evolve_tumblr; ?>" data-toggle="tooltip" data-placement="bottom" id="tumblr"
               title="<?php _e( 'Tumblr', 'evolve' ); ?>"><i class="t4p-icon-social-tumblr"></i></a></li>
		<?php
	}
	?>
</ul>