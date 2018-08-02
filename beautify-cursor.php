<?php
/*
Plugin Name: Beautify Cursor
Plugin URI: https://wordpress.org/plugins/beautify-cursor
Description: Beautify your cursor style based on the wide variety of icons available with the plugin.
Version: 1.0
Author: Muntasir Mahmud
Author URI: http://aumio.rocks
Text Domain: beautify-cursor
Domain Path: /languages
*/


if ( ! defined('ABSPATH') ) die;
/**
 *
 * Xeroft Framework
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

// Define Plugin Directory URL
if ( ! defined( 'BTFC_PLUGIN_URL' ) ) define( 'BTFC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Define App Image URL
if ( ! defined( 'BTFC_IMG_URL' ) ) define( 'BTFC_IMG_URL', plugin_dir_url( __FILE__ ) . 'app/assets/img' );

if ( ! defined( 'BTFC_IMG_PATH' ) ) define( 'BTFC_IMG_PATH', plugin_dir_path( __FILE__ ) . 'app/assets/img' );


function btfc_enqueue_scripts() {
    // Main Plugin Css
    wp_enqueue_style( 'btfc-main-style', plugin_dir_url( __FILE__ ) . 'app/assets/css/main.css' );
}
add_action( 'wp_enqueue_scripts', 'btfc_enqueue_scripts' );


function xeroft_framework_init() {
	include 'framework/functions/enqueue.php';
	include 'framework/classes/xr.abstract.class.php';
	include 'framework/functions/helper.php';
	include 'framework/classes/xr.framework.class.php';
	include 'app/config/xr.framework.config.php';

	load_plugin_textdomain( 'beautify-cursor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}
add_action('init', 'xeroft_framework_init');


function btfc_enequeue_custom_style() { 
	$bc_opt = get_option( 'xr_options' );
	?>
	<style type="text/css">
		body {
			cursor: url(<?php echo $bc_opt['body-cursor-opt'][0]; ?>), auto;
		}

		a {
			cursor: url(<?php echo $bc_opt['link-cursor-opt'][0]; ?>), auto;
		}

		input:focus {
			cursor: url(<?php echo $bc_opt['input-cursor-opt'][0]; ?>), auto;
		}
	</style>	

<?php
}

add_action( 'wp_head', 'btfc_enequeue_custom_style' );