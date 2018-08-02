<?php
/**
 *
 * Beautify Cursor Configuration
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */


$settings           = array(
  'menu_title'      => __( 'Cursor Options', 'beautify-cursor' ),
  'menu_type'       => 'options', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'cursor-options',
  'framework_title' => 'Xeroft Framework',
);


$btfc_images = glob( BTFC_IMG_PATH . '/*.png' );

$cursor_options = array();
foreach ($btfc_images as $image) {
    
    $cursor_options[trailingslashit( BTFC_IMG_URL ) . basename($image)] = trailingslashit( BTFC_IMG_URL ) . basename($image);
}



$options[] = array(
    'name'    => 'overview',
    'title'   => __( 'General Settings', 'beautify-cursor' ),
    'fields'  => array(
        array(
            'id' => 'body-cursor-opt',
            'type' => 'image_select',
            'title' => __( 'Body Cursor', 'beautify-cursor' ),
            'options' => $cursor_options,
            'default' => BTFC_IMG_URL . '/two-pointers.png'
            ),
        array(
            'id' => 'link-cursor-opt',
            'type' => 'image_select',
            'title' => __( 'Link Cursor', 'beautify-cursor' ),
            'options' => $cursor_options,
            'default' => BTFC_IMG_URL . '/two-pointers.png'
            ),
        array(
            'id' => 'input-cursor-opt',
            'type' => 'image_select',
            'title' => __( 'Input Focus Cursor', 'beautify-cursor' ),
            'options' => $cursor_options,
            'default' => BTFC_IMG_URL . '/two-pointers.png'
            ),
        )
    );


Xeroft_Framework::instance( $settings, $options );