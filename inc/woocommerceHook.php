<?php

/**
 * sawo_woocommerceHook : Only For Woocommerce 3+ (added restriction to execute the code only once)
 *
 * @param  mixed $order_id
 * @return void
 */
function sawo_woocommerceHook( $order_id ) {
    if ( ! $order_id )
        return;

    // Allow code execution only once 
    if( ! get_post_meta( $order_id, '_thankyou_action_done', true ) ) {

        // Get an instance of the WC_Order object
        $order = wc_get_order( $order_id );

        // Get the order key
        $order_key = $order->get_order_key();

        // Get the order number
        $order_number = $order->get_order_number();

        if($order->is_paid())
            $paid = __('yes');
        else
            $paid = __('no');

        // Loop through order items
        // foreach ( $order->get_items() as $item_id => $item ) {

        //     // Get the product object
        //     $product = $item->get_product();

        //     // Get the product Id
        //     $product_id = $product->get_id();

        //     // Get the product name
        //     $product_id = $item->get_name();
        // }
        // send sms here
        // Get customer billing information details
        $billing_first_name = $order->get_billing_first_name();
        $billing_last_name  = $order->get_billing_last_name();
        $billing_company    = $order->get_billing_company();
        $billing_address_1  = $order->get_billing_address_1();
        $billing_address_2  = $order->get_billing_address_2();
        $billing_city       = $order->get_billing_city();
        $billing_state      = $order->get_billing_state();
        $billing_postcode   = $order->get_billing_postcode();
        $billing_country    = $order->get_billing_country();
        
        // Get customer shipping information details
        $shipping_first_name = $order->get_shipping_first_name();
        $shipping_last_name  = $order->get_shipping_last_name();
        $shipping_company    = $order->get_shipping_company();
        $shipping_address_1  = $order->get_shipping_address_1();
        $shipping_address_2  = $order->get_shipping_address_2();
        $shipping_city       = $order->get_shipping_city();
        $shipping_state      = $order->get_shipping_state();
        $shipping_postcode   = $order->get_shipping_postcode();
        $shipping_country    = $order->get_shipping_country();
        $user = $order->get_user(); // Fetch all the other user data from here.
        $content = [];
        $template = get_option("sawo_woocomerce_order_sms_template");
        if(!empty($template)){
             $content['send_to'] = ""; // Add user number here.
             $content['message'] = ""; // Create content that you want using $order & $user.
             sawo_sendSms($content); // Use your send function to send API request.
        }
       
        // Output some data
        echo '<p>Order ID: '. $order_id . ' — Order Status: ' . $order->get_status() . ' — Order is paid: ' . $paid . '</p>';

        // Flag the action as done (to avoid repetitions on reload for example)
        $order->update_meta_data( '_thankyou_action_done', true );
        $order->save();
    }
}
add_action('woocommerce_thankyou', 'sawo_woocommerceHook', 10, 1);