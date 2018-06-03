<?php
$evolve_title_class_1          = "";
$evolve_title_class_2          = "";
$evolve_title_tagline_class_1  = '';
$evolve_title_tagline_class_2  = '';
$evolve_helper_tagline_class_1 = '';
$evolve_helper_tagline_class_2 = '';
?>

<div class="header-pattern">

	<?php if ( get_header_image() ) {
		echo '<div class="custom-header">';
	} ?>

    <div class="header container header_v0">
        <div class="row align-items-center">

			<?php
			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" ) {
				$evolve_social_class = 'col order-1 order-sm-1 order-md-3';
			} else {
				$evolve_social_class = 'col order-1 order-sm-1 order-md-2';
			}

			if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'disable' ) {
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "center" ) {
					$evolve_social_class = 'col-12 order-1 order-sm-1';
				}
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "left" ) {
					$evolve_social_class = 'col col-md-12 col-lg-auto order-1 order-sm-1 order-md-1 order-lg-3';
				}
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "right" ) {
					$evolve_social_class = 'col-12 order-1';
				}
			}
			echo '<div class="col-md-auto ml-auto ' . $evolve_social_class . '">';

			if ( evolve_theme_mod( 'evl_social_links', 0 ) ) {
				get_template_part( 'template-parts/header/header', 'social-buttons' );
			}

			if ( class_exists( 'Woocommerce' ) && ( evolve_theme_mod( 'evl_woocommerce_acc_link_main_nav', false ) || evolve_theme_mod( 'evl_woocommerce_cart_link_main_nav', false ) ) ) {
				global $woocommerce;
				?>

                <div class="woocommerce-menu-holder">
                    <ul class="woocommerce-menu">

						<?php if ( evolve_theme_mod( 'evl_woocommerce_acc_link_main_nav', false ) ): ?>

                            <li class="my-account">
                                <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"
                                   class="my-account-link"><?php esc_html_e( 'My Account', 'evolve' ); ?></a>

								<?php if ( ! is_user_logged_in() ): ?>

                                    <div class="login-box">
                                        <form action="<?php echo wp_login_url(); ?>" name="loginform"
                                              method="post">
                                            <p>
                                                <input type="text" class="input-text" name="log"
                                                       id="username" value=""
                                                       placeholder="<?php echo esc_html__( 'Username', 'evolve' ); ?>"/>
                                            </p>
                                            <p>
                                                <input type="password" class="input-text" name="pwd"
                                                       id="pasword" value=""
                                                       placeholder="<?php echo esc_html__( 'Password', 'evolve' ); ?>"/>
                                            </p>
                                            <p class="forgetmenot">
                                                <label for="rememberme"><input name="rememberme"
                                                                               type="checkbox"
                                                                               id="rememberme"
                                                                               value="forever"> <?php esc_html_e( 'Remember Me', 'evolve' ); ?>
                                                </label>
                                            </p>
                                            <p class="submit">
                                                <input type="submit" name="wp-submit" id="wp-submit"
                                                       class="btn btn-sm"
                                                       value="<?php esc_html_e( 'Log In', 'evolve' ); ?>">
                                                <input type="hidden" name="redirect_to"
                                                       value="<?php if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
													       echo $_SERVER['HTTP_REFERER'];
												       } ?>">
                                                <input type="hidden" name="testcookie" value="1">
                                            </p>
                                            <div class="clear"></div>
                                        </form>
                                    </div>

								<?php else: ?>

                                    <ul class="sub-menu">
                                        <li>
                                            <a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php esc_html_e( 'Logout', 'evolve' ); ?></a>
                                        </li>
                                    </ul>

								<?php endif; ?>

                            </li><!-- li.my-account -->

						<?php endif;

						if ( evolve_theme_mod( 'evl_woocommerce_cart_link_main_nav', false ) ): ?>

                            <li class="cart">

								<?php if ( ! $woocommerce->cart->cart_contents_count ): ?>

                                    <a class="empty-cart"
                                       href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>">
										<?php echo wc_price( $woocommerce->cart->cart_contents_total ); ?>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <div class="cart-contents">
                                                <div class="cart-content">
                                                    <strong style="padding:7px 10px;line-height:35px;">
														<?php esc_html_e( 'Your cart is currently empty.', 'evolve' ); ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

								<?php else: ?>

                                    <a class="my-cart-link my-cart-link-active"
                                       href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>">
										<?php echo wc_price( $woocommerce->cart->cart_contents_total ); ?>
                                    </a>
                                    <div class="cart-contents">

										<?php
										foreach ( $woocommerce->cart->cart_contents as $cart_item ): //var_dump($cart_item);
											$cart_item_key = $cart_item['key'];
											$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
											?>

                                            <div class="cart-content">
                                                <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

													<?php
													$evolve_thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
													echo $evolve_thumbnail;
													?>

                                                    <div class="cart-desc">
                                                        <span class="cart-title"><?php echo $cart_item['data']->get_name(); ?></span>
                                                        <span class="product-quantity">

                                                                            <?php echo $cart_item['quantity']; ?>
                                                            x <?php echo $woocommerce->cart->get_product_subtotal( $cart_item['data'], $cart_item['quantity'] ); ?>

                                                                        </span>
                                                    </div>
                                                </a>
                                            </div>

										<?php endforeach; ?>

                                        <div class="cart-checkout">
                                            <div class="cart-link">
                                                <a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>"><?php esc_html_e( 'View Cart', 'evolve' ); ?></a>
                                            </div>
                                            <div class="checkout-link">
                                                <a href="<?php echo get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); ?>"><?php esc_html_e( 'Checkout', 'evolve' ); ?></a>
                                            </div>
                                        </div>
                                    </div><!-- .cart-contents -->

								<?php endif; ?>

                            </li><!-- li.cart -->

						<?php endif; ?>

                    </ul><!-- ul.woocommerce-menu -->
                </div><!-- .woocommerce-menu-holder -->

			<?php }

			echo '</div>';

			if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {

			} else {

				if ( evolve_theme_mod( 'evl_header_logo', '' ) ) {
					if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "center" ) {
						$evolve_logo_class = 'col-12 order-2 header-logo-container';
					}
					if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "left" ) {
						$evolve_logo_class = 'col-md-auto order-2 header-logo-container';
					}
					if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "right" ) {
						$evolve_logo_class = 'col col-md-6 col-sm-12 order-2 order-md-3 header-logo-container';
					}
					echo "<div class='" . $evolve_logo_class . "'><a href=" . home_url() . "><img id='logo-image' class='img-responsive' alt='" . get_bloginfo( 'name' ) . "' src=" . evolve_theme_mod( 'evl_header_logo', '' ) . " /></a></div>";
				}
			}

			if ( ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "disable" && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "next" && ('' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) )) || evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ||
			     ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "disable" && ('' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) )) ) {
				$evolve_title_tagline_class_1 = '<div class="col-md-auto order-1 order-sm-2 order-md-1">';
				$evolve_title_tagline_class_2 = '</div>';
			}

			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {
				$evolve_title_tagline_class_1 = '';
				$evolve_title_tagline_class_2 = '';
			}

			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "disable" && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "next" && ('' == ( evolve_theme_mod( 'evl_header_logo', '' ) )) || evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {
				echo $evolve_title_tagline_class_1;
			}

			if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'disable' ) {
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "center" ) {
					$evolve_tagline_class_1        = '<div class="col-12 order-2 order-md-2">';
					$evolve_tagline_class_2        = '</div>';
					$evolve_helper_tagline_class_1 = '<div class="col-12 order-2">';
					$evolve_helper_tagline_class_2 = '</div>';
				}
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "left" ) {
					$evolve_tagline_class_1        = '<div class="col-12 order-2 order-md-2">';
					$evolve_tagline_class_2        = '</div>';
					$evolve_helper_tagline_class_1 = '<div class="col col-sm-12 col-md-auto order-2">';
					$evolve_helper_tagline_class_2 = '</div>';
				}
				if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "right" ) {
					$evolve_tagline_class_1        = '<div class="col-12 order-2 order-md-2">';
					$evolve_tagline_class_2        = '</div>';
					$evolve_helper_tagline_class_1 = '<div class="col-md-6 col-sm-12 order-3 order-md-2">';
					$evolve_helper_tagline_class_2 = '</div>';
				}
			}

			if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_pos_logo', 'left' ) == 'disable' ) {
				$evolve_tagline_class_1        = '';
				$evolve_tagline_class_2        = '';
				$evolve_helper_tagline_class_1 = '';
				$evolve_helper_tagline_class_2 = '';
			}

			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" ) {
				$evolve_tagline_class_1 = '<div class="col-md-auto order-2 order-md-2">';
				$evolve_tagline_class_2 = '</div>';
			} else {
				$evolve_tagline_class_1 = "";
				$evolve_tagline_class_2 = "";
			}

			if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'center' && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'disable' ) {
				$evolve_row_class_1 = '<div class="row align-items-center">';
				$evolve_row_class_2 = '</div>';
			} else {
				$evolve_row_class_1 = '';
				$evolve_row_class_2 = '';
			}

			echo $evolve_helper_tagline_class_1 . $evolve_row_class_1;

			$evolve_tagline = $evolve_tagline_class_1 . '<div id="tagline">' . get_bloginfo( 'description' ) . '</div>' . $evolve_tagline_class_2;
			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "disable" && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "above" ) {
				echo $evolve_tagline;
			}

			if ( evolve_theme_mod( 'evl_blog_title', false ) == "0" || ! evolve_theme_mod( 'evl_blog_title', false ) ) {

				if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" ) {
					$evolve_title_class_1 = '<div class="col-md-auto order-1 order-sm-2 order-md-2">';
					$evolve_title_class_2 = '</div>';
				} else if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "disable" && ('' == ( evolve_theme_mod( 'evl_header_logo', '' ) )) ) {
					$evolve_title_class_1 = "<div class='col-md-auto order-1 order-sm-2 order-md-1'>";
					$evolve_title_class_2 = "</div>";
				} else if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_header_logo', '' ) ) {
					$evolve_title_class_1 = "<div class='col-md-auto order-3 order-md-1'>";
					$evolve_title_class_2 = "</div>";
				} else if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && ('' == ( evolve_theme_mod( 'evl_header_logo', '' ) )) ) {
					$evolve_title_class_1 = "<div class='col-md-auto order-2 order-md-1'>";
					$evolve_title_class_2 = "</div>";
				} else {
					$evolve_title_class_1 = "";
					$evolve_title_class_2 = "";
				}

				if ( is_front_page() ) :

					echo $evolve_title_class_1;
					?><h1 id="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
                    </h1><?php
					echo $evolve_title_class_2;

				else :

					echo $evolve_title_class_1;
					?><h4 id="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
                    </h4><?php
					echo $evolve_title_class_2;

				endif;
			}

			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "disable" && ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "" || evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" || evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "under" ) ) {
				echo $evolve_tagline;
			}

			if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "disable" && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "next" && ('' == ( evolve_theme_mod( 'evl_header_logo', '' ) )) || evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {
				echo $evolve_title_tagline_class_2;
			}

			if ( ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'disable' ) || ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" ) ) {
				echo $evolve_row_class_2 . $evolve_helper_tagline_class_2;
			}
			?>

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
					echo '<nav class="navbar navbar-expand-md mr-auto col-md-11 col-sm-11">
                                <div class="navbar-toggler" data-toggle="collapse" data-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
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
                      class="searchform col-md-1 col-sm-1">
                    <div id="search-text-box">
                        <label class="searchfield col-md-1 col-sm-1" id="search_label_top"
                               for="search-text-top"><input id="search-text-top" type="text"
                                                            tabindex="1"
                                                            name="s" class="search"
                                                            placeholder="<?php esc_html_e( 'Type your search', 'evolve' ); ?>"/></label>
                    </div>
                </form>

			<?php } ?>

        </div><!-- .row -->
    </div><!-- .container .container-menu -->
</header><!-- .menu-header -->



