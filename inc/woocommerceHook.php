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
        $billing_phone   = $order->get_billing_phone();
        $contents = [];
        $template = get_option("sawo_woocomerce_order_sms_template");
        if(!empty($template)){
            // replace order number and user name in template
            $content = str_replace("#ordernumber",$order_number,$template);
            $content = str_replace("#name", $billing_first_name, $content);
            update_option( "sawo_woocomerce_order_sms_template_sent", $content." : Sent to ".$billing_phone);
             $contents['send_to'] = $billing_phone; // Add user number here.
             $contents['message'] =  $content; // Create content that you want using $order & $user.
             sawo_sendSms($contents); // Use your send function to send API request.
        }
       
        // Output some data
        

        // Flag the action as done (to avoid repetitions on reload for example)
        $order->update_meta_data( '_thankyou_action_done', true );
        $order->save();
    }
}
add_action('woocommerce_thankyou', 'sawo_woocommerceHook', 10, 1);