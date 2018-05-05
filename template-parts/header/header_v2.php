<?php

$evolve_social_links                   = evolve_get_option( 'evl_social_links', '1' );
$evolve_responsive_menu_layout         = evolve_get_option( 'evl_responsive_menu_layout', 'basic' );
$evolve_woocommerce_cart_link_main_nav = evolve_get_option( 'evl_woocommerce_cart_link_main_nav', '0' );
$evolve_woocommerce_acc_link_main_nav  = evolve_get_option( 'evl_woocommerce_acc_link_main_nav', '0' );
$evolve_width_layout                   = evolve_get_option( 'evl_width_layout', 'fixed' );
$evolve_header_logo                    = evolve_get_option( 'evl_header_logo', '' );
$evolve_tagline_pos                    = evolve_get_option( 'evl_tagline_pos', 'next' );
$evolve_blog_title                     = evolve_get_option( 'evl_blog_title', '0' );
$evolve_main_menu                      = evolve_get_option( 'evl_main_menu', '0' );
$evolve_searchbox                      = evolve_get_option( 'evl_searchbox', '1' );
$evolve_sticky_header                  = evolve_get_option( 'evl_sticky_header', '1' );

?>

<div class="new-top-menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-12">
				<?php
				if ( $evolve_social_links == "1" ) {
					?>
                    <div class="top-menu-social-container">
                        <!--BEGIN #subscribe-follow-->
                        <div class="top-menu-social">
							<?php
							get_template_part( 'template-parts/social-buttons', 'header' );
							?>
                        </div>
                    </div>
                    <!--END #subscribe-follow-->
				<?php } ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <!--BEGIN #Woocommerce-->
				<?php

				if ( class_exists( 'Woocommerce' ) && ( $evolve_woocommerce_acc_link_main_nav || $evolve_woocommerce_cart_link_main_nav ) ) {
					global $woocommerce;
					?>
                    <div class="woocommerce-menu-holder">
                        <ul class="woocommerce-menu">
							<?php if ( $evolve_woocommerce_cart_link_main_nav ): ?>
                                <li class="cart header-cart">
									<?php if ( ! $woocommerce->cart->cart_contents_count ): ?>
                                        <a class="empty-cart"
                                           href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>">
											<?php echo wc_price( $woocommerce->cart->cart_contents_total ); ?>
                                        </a>
                                        <div class="cart-contents">
                                            <div class="cart-content" style="width:180px!important;">
                                                <strong style="padding:7px 10px;line-height:35px;">
													<?php _e( 'Your cart is currently empty.', 'evolve' ); ?>
                                                </strong>
                                            </div>
                                        </div>

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
                                                    <a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>"><?php _e( 'View Cart', 'evolve' ); ?></a>
                                                </div>
                                                <div class="checkout-link">
                                                    <a href="<?php echo get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); ?>"><?php _e( 'Checkout', 'evolve' ); ?></a>
                                                </div>
                                            </div>
                                        </div><!-- /.cart-contents -->
									<?php endif; //if(!$woocommerce->cart->cart_contents_count):      ?>
                                </li><!-- /li.cart -->
							<?php
							endif;

							if ( $evolve_woocommerce_acc_link_main_nav ):
								?>
                                <li class="my-account">
                                    <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"
                                       class="my-account-link">
                                        <i class="t4p-icon-user"></i>
										<?php _e( 'My Account', 'evolve' ); ?></a>
									<?php if ( ! is_user_logged_in() ): ?>
                                        <div class="login-box">
                                            <form action="<?php echo wp_login_url(); ?>" name="loginform" method="post">
                                                <p>
                                                    <input type="text" class="input-text" name="log" id="username"
                                                           value=""
                                                           placeholder="<?php echo __( 'Username', 'evolve' ); ?>"/>
                                                </p>
                                                <p>
                                                    <input type="password" class="input-text" name="pwd" id="pasword"
                                                           value=""
                                                           placeholder="<?php echo __( 'Password', 'evolve' ); ?>"/>
                                                </p>
                                                <p class="forgetmenot">
                                                    <label for="rememberme"><input name="rememberme" type="checkbox"
                                                                                   id="rememberme"
                                                                                   value="forever"> <?php _e( 'Remember Me', 'evolve' ); ?>
                                                    </label>
                                                </p>
                                                <p class="submit">
                                                    <input type="submit" name="wp-submit" id="wp-submit"
                                                           class="button small default comment-submit"
                                                           value="<?php _e( 'Log In', 'evolve' ); ?>">
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
                                                <a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e( 'Logout', 'evolve' ); ?></a>
                                            </li>
                                        </ul>
									<?php endif; ?>
                                </li><!-- /li.my-account -->
							<?php endif; ?>
                        </ul><!-- /ul.woocommerce-menu -->
                    </div><!-- /span .woocommerce-menu-holder -->
				<?php } ?>
                <!--END #Woocommerce-->
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="header-pattern">
    <div class="menu-header-sticky">
        <div class="header-border<?php
		if ( get_header_image() ) {
			echo ' custom-header';
		}
		?>">
            <div class="header-bg"></div>
            <!--BEGIN .header-->
            <div class="header">
                <div class="container nacked-menu container-menu">
                    <div class="row align-items-center">
                        <div class="col">
							<?php

							if ( $evolve_header_logo ) {
								echo "<div class='header-logo-container clearfix'><a href=" . home_url() . "><img id='logo-image' class='img-responsive' alt='" . get_bloginfo( 'name' ) . "' src=" . $evolve_header_logo . " /></a></div>";
							}

							$evolve_tagline = '<span id="tagline">' . get_bloginfo( 'description' ) . '</span>';

							if ( $evolve_blog_title == "0" || ! $evolve_blog_title ) {
								if ( is_front_page() ) :
									?>
                                    <h1 id="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
                                    </h1>
								<?php else : ?>
                                    <h4 id="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
                                    </h4>
								<?php
								endif;
							} else {

							}
							if ( ( $evolve_tagline_pos !== "disable" ) ) {
								echo $evolve_tagline;
							}
							?>
                        </div>
                        <div class="headerbar col-md-6">
                            <!--BEGIN .container-menu-->
                            <div class="container-menu">
								<?php
								if ( $evolve_main_menu == "1" ) {
									?>

								<?php } else { ?>
                                    <div class="p-menu-stick">

										<?php
										if ( has_nav_menu( 'primary-menu' ) ) {
											echo '<nav class="nav nav-holder link-effect">';
											wp_nav_menu( array(
												'theme_location' => 'primary-menu',
												'menu_class'     => 'nav-menu',
												'fallback_cb'    => 'wp_page_menu',
												'walker'         => new evolve_custom_menu_walker()
											) );

											if ( $evolve_responsive_menu_layout == 'dropdown' ) {
												wp_nav_menu( array(
													'theme_location'  => 'primary-menu',
													'container_class' => 'evolve_mobile_menu',
													'menu_class'      => 'nav-menu'
												) );
											}
										} else {
										?>
                                        <nav class="nav nav-holder">
											<?php
											wp_nav_menu( array(
												'theme_location' => 'primary-menu',
												'menu_class'     => 'nav-menu'
											) );
											}
											?>
                                        </nav>
                                    </div><!-- /.primary-menu -->
								<?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
						<?php

						if ( $evolve_searchbox == "1" ) {
							?>
                            <div class="col-md-3">
                                <!--BEGIN #searchform-->
                                <form action="<?php echo home_url(); ?>" method="get" class="searchform">
                                    <div id="search-text-box">
                                        <label class="searchfield" id="search_label_top" for="search-text-top"><input
                                                    id="search-text-top" type="text" tabindex="1" name="s"
                                                    class="search"
                                                    placeholder="<?php _e( 'Type your search', 'evolve' ); ?>"/><span
                                                    class="srch-btn"></span></label>
                                    </div>
                                </form>
                            </div>
						<?php } ?>
                        <div class="menu-header">
							<?php

							if ( $evolve_sticky_header == "1" ) {
								// sticky header
								get_template_part( 'template-parts/sticky-header' );
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!--END .header-->
        </div>
        <!--END .header-border-->
    </div>
</div>