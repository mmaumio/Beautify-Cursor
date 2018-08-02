<?php
if ( ! defined('ABSPATH') ) die;
/**
 *
 * Abstract Class
 * Helper class for action and filter hooks
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

abstract class Xeroft_Framework_Abstract {

    public function __construct() {}

    public function add_action( $hook, $function_to_add, $priority = 30, $accepted_args = 1 ) {
        add_action( $hook, array( &$this, $function_to_add), $priority, $accepted_args );
    }

    public function add_filter( $tag, $function_to_add, $priority = 30, $accepted_args = 1 ) {
        add_action( $tag, array( &$this, $function_to_add), $priority, $accepted_args );
    }

}