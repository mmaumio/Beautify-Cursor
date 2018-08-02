<?php
/**
*
* Enqueue Admin styles and scripts
*
*/

function xeroft_admin_enqueue_scripts() {
    
    // Enqueue Media
    wp_enqueue_media();

    // Enqueue Color Picker
    wp_enqueue_style( 'wp-color-picker' );

    // Icon picker css
    wp_enqueue_style( 'icon-picker', BTFC_PLUGIN_URL . 'framework/assets/css/icon-picker.css' );

    // Main Admin css
    wp_enqueue_style( 'main-admin', BTFC_PLUGIN_URL . 'framework/assets/css/main-admin.css' );

    // Enqueue admin scripts
    wp_enqueue_script( 'wp-color-picker' );
    // Dashicon picker
    wp_enqueue_script( 'dashicons-picker', BTFC_PLUGIN_URL . 'framework/assets/js/icon-picker.js', array( 'jquery' ), '1.0' );
    // Custom Script
    wp_enqueue_script( 'admin-js', BTFC_PLUGIN_URL . 'framework/assets/js/xr-admin.js', array('jquery'), false, true );
}

add_action( 'admin_enqueue_scripts', 'xeroft_admin_enqueue_scripts' );