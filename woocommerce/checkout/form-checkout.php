<?php
/**
 * Checkout Form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

$woocommerce_one_page_checkout = evolve_theme_mod( 'evl_woocommerce_one_page_checkout', '0' );

global $woocommerce, $current_user;
$woo_acc_msg_1 = evolve_theme_mod( 'evl_woo_acc_msg_1', 'Call us - <i class="t4p-icon-phone"></i> 7438 882 764' );
$woo_acc_msg_2 = evolve_theme_mod( 'evl_woo_acc_msg_2', 'Email us - <i class="t4p-icon-envelope-o"></i> contact@example.com' );
?>

    <div class="myaccount_user_container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <h3><?php
					printf(
						__( 'Hello, %s', 'evolve' ), $current_user->display_name
					);
					?></h3>
            </div>

			<?php if ( $woo_acc_msg_1 ): ?>

                <div class="col-sm-12 col-md-6 col-lg-3 mb-3">

					<?php echo $woo_acc_msg_1; ?>

                </div>

			<?php endif;
			if ( $woo_acc_msg_2 ): ?>

                <div class="col-sm-12 col-md-6 col-lg-3 mb-3">

					<?php echo $woo_acc_msg_2; ?>

                </div>

			<?php endif; ?>

            <div class="col-sm-12 col-md-6 col-lg-3">
                <form action="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>">
                    <button type="submit"
                            class="btn btn-sm float-lg-right"><?php esc_html_e( 'View Cart', 'evolve' ); ?></button>
                </form>
            </div>
        </div>
    </div>

<?php
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'evolve' ) );

	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', wc_get_checkout_url() );
?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout"
          action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>


            <div class="checkout-billing">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>

            <div class="checkout-shipping">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
            </div>


			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'evolve' ); ?></h3>

		<?php
		endif;

		do_action( 'woocommerce_checkout_before_order_review' );
		?>

        <div id="order-review" class="woocommerce-checkout-review-order">

			<?php do_action( 'woocommerce_checkout_order_review' ); ?>

        </div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

    </form>

<?php
do_action( 'woocommerce_after_checkout_form', $checkout );
