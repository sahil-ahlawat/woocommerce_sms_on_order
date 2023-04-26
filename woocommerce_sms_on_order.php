<?php
/*
Plugin Name: Woocommerce sms on order
Plugin URI: 
Description: Woocommerce sms on order.
Version: 1.0.0
Author: Sahil Ahlawat
Author URI: https://freelancingdiary.com

*/

// initiating everything
foreach ( glob( plugin_dir_path( __FILE__ ) . "module/*.php" ) as $file ) {
	include_once $file;
}
add_action("init", function () {
	
    foreach ( glob( plugin_dir_path( __FILE__ ) . "inc/*.php" ) as $file ) {
		include_once $file;
	}
	foreach ( glob( plugin_dir_path( __FILE__ ) . "backend/*.php" ) as $file ) {
		include_once $file;
	}
	
});
