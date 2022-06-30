<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/junaidzx90
 * @since             1.0.0
 * @package           Affiliate_Products
 *
 * @wordpress-plugin
 * Plugin Name:       Affiliate Products
 * Plugin URI:        https://www.fiverr.com
 * Description:       Promote affiliate products with this plugin, this plugin allows you to create products and send the visitor to the targeted site.
 * Version:           1.0.0
 * Author:            Developer Junayed
 * Author URI:        https://www.fiverr.com/junaidzx90
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       affiliate-products
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'AFFILIATE_PRODUCTS_VERSION', '1.0.0' );

function get_product_ratings($ratings){
	$output = '';
	$x = 0;
	for($i = 0; $i < intval($ratings); $i++){
		$output .= '<i style="color: #ff9800;" class="fas fa-star"></i>';
		$x++;
	}
	$left = 5-$x;
	for ($y=0; $y < $left; $y++) { 
		$output .= '<i style="color: #ddd;" class="fas fa-star"></i>';
	}

	return $output;
}

add_action( "init", function(){
	add_image_size( 'product_thumbnail',  265, 331, array('center', 'center') );
} );

add_action( "wp_head", function(){
	if(is_singular( "products" )){
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	}
});
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-affiliate-products-activator.php
 */
function activate_affiliate_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-affiliate-products-activator.php';
	Affiliate_Products_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-affiliate-products-deactivator.php
 */
function deactivate_affiliate_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-affiliate-products-deactivator.php';
	Affiliate_Products_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_affiliate_products' );
register_deactivation_hook( __FILE__, 'deactivate_affiliate_products' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-affiliate-products.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_affiliate_products() {

	$plugin = new Affiliate_Products();
	$plugin->run();

}
run_affiliate_products();
