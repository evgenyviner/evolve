<div class="sticky-header">

	<?php
	$evolve_width_layout            = evolve_theme_mod( 'evl_width_layout', 'fixed' );
	$evolve_frontpage_width_layout  = evolve_theme_mod( 'evl_frontpage_width_layout', 'fixed' );
	$evolve_pos_logo                = evolve_theme_mod( 'evl_pos_logo', 'left' );
	$evolve_blog_title              = evolve_theme_mod( 'evl_blog_title', '0' );
	$evolve_searchbox_sticky_header = evolve_theme_mod( 'evl_searchbox_sticky_header', '1' );
	?>

    <div class="container container-menu">
        <div class="row align-items-center">

			<?php if ( $evolve_pos_logo == "disable" ) {

			} else {

				if ( evolve_theme_mod( 'evl_header_logo', '' ) ) {
					echo "<div class=\"col-1\"><a href=" . home_url() . "><img src=" . evolve_theme_mod( 'evl_header_logo', '' ) . "  alt=" . get_bloginfo( 'name' ) . "/></a></div>";
				}
			}

			if ( $evolve_blog_title == "0" ) { ?>

                <div class="col-2">
                    <a id="sticky-title" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
                </div>

			<?php } ?>

			<?php if ( has_nav_menu( 'sticky_navigation' ) ) {
				echo '<nav class="navbar navbar-expand-md col-' . ( ( $evolve_pos_logo == 'disable' || '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) ? "9" : "8" ) . '">
                                <div class="navbar-toggler" data-toggle="collapse" data-target="#sticky-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon-svg"></span>
                                </div><div id="sticky-menu" class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">';
				wp_nav_menu( array(
					'theme_location' => 'sticky_navigation',
					'depth'          => 10,
					'container'      => false,
					'menu_class'     => 'navbar-nav mr-auto',
					'fallback_cb'    => 'evolve_custom_menu_walker::fallback',
					'walker'         => new evolve_custom_menu_walker()
				) );
				echo '</div></nav>';
			} elseif ( has_nav_menu( 'primary-menu' ) ) {
				echo '<nav class="navbar navbar-expand-md col-' . ( ( $evolve_pos_logo == 'disable' || '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) ? "9" : "8" ) . '">
                                <div class="navbar-toggler" data-toggle="collapse" data-target="#sticky-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon-svg"></span>
                                </div><div id="sticky-menu" class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">';
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'depth'          => 10,
					'container'      => false,
					'menu_class'     => 'navbar-nav mr-auto',
					'fallback_cb'    => 'evolve_custom_menu_walker::fallback',
					'walker'         => new evolve_custom_menu_walker()
				) );
				echo '</div></nav>';
			}

			if ( $evolve_searchbox_sticky_header == "1" ) { ?>

                <form action="<?php echo home_url(); ?>" method="get"
                      class="header-search search-form col-1 ml-auto">
                    <label>
                        <input type="text" tabindex="1" name="s" class="form-control"
                               placeholder="<?php esc_html_e( 'Type your search', 'evolve' ); ?>"/>

						<?php echo evolve_get_svg( 'search' ); ?>

                    </label>

                </form>

			<?php } ?>

        </div>
    </div>
</div><!-- .sticky-header -->
