<div class="header-pattern">

	<?php if ( get_header_image() ) {
		echo '<div class="custom-header">';
	} ?>

    <div class="header container header_v0">
        <div class="row align-items-center">

			<?php
			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" ) {
				$evolve_social_woo_class = 'col order-1 order-md-3';
			} else {
				$evolve_social_woo_class = 'col order-1 order-md-2';
			}

			if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'disable' ) {
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "center" ) {
					$evolve_social_woo_class = 'col-12 order-1';
				}
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "left" ) {
					$evolve_social_woo_class = 'col col-lg-7 order-1 order-md-3';
				}
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "right" ) {
					$evolve_social_woo_class = 'col-12 order-1';
				}
			}

			echo '<div class="' . $evolve_social_woo_class . '">';

			if ( evolve_theme_mod( 'evl_social_links', 0 ) ) {
				get_template_part( 'template-parts/header/header', 'social-buttons' );
			}

			if ( function_exists( 'evolve_woocommerce_menu' ) ) {
				evolve_woocommerce_menu();
			}

			echo '</div>';

			if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) != "disable" ) {
				get_template_part( 'template-parts/header/header', 'logo' );
			}

			get_template_part( 'template-parts/header/header', 'tagline-above' );

			if ( evolve_theme_mod( 'evl_blog_title', '0' ) != "1" ) {
				get_template_part( 'template-parts/header/header', 'website-title' );
			}

			get_template_part( 'template-parts/header/header', 'tagline-next-under' ); ?>

        </div><!-- .row .align-items-center -->

		<?php
		if ( get_header_image() ) {
			echo '</div><!-- .custom-header -->';
		}
		?>

    </div><!-- .header .container .header_v0 -->
</div><!-- .header-pattern -->

<header class="menu-header">
    <div class="container container-menu">
        <div class="row align-items-center">

			<?php if ( evolve_theme_mod( 'evl_main_menu', false ) !== true ) {

				if ( has_nav_menu( 'primary-menu' ) ) {
					echo '<nav class="navbar navbar-expand-md mr-auto col-sm-11">
                                <div class="navbar-toggler" data-toggle="collapse" data-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                                    ' . evolve_get_svg( 'menu' ) . '
                                    </div>
                                <div id="primary-menu" class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">';
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
			}

			if ( evolve_theme_mod( 'evl_searchbox', true ) ) { ?>

                <form action="<?php echo home_url(); ?>" method="get"
                      class="header-search search-form col-sm-1 ml-auto">
                    <label>
                        <input type="text" tabindex="1" name="s" class="form-control"
                               placeholder="<?php esc_html_e( 'Type your search', 'evolve' ); ?>"/>

						<?php echo evolve_get_svg( 'search' ); ?>

                    </label>

                </form>

			<?php } ?>

        </div><!-- .row -->
    </div><!-- .container .container-menu -->
</header><!-- .menu-header -->



