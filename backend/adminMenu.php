<?php
/**
 * sawo_plugin_setup_menu : Setup Admin menu
 *
 * @return void
 */
function sawo_plugin_setup_menu(){

	add_menu_page('Woocommerce order template', 'Woocommerce order template', 'manage_options', 'sa-woocommerce-order-template', 'sawo_Ui', "dashicons-image-rotate-right", 2);
}
add_action('admin_menu', 'sawo_plugin_setup_menu');