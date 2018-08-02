<?php
if ( ! defined('ABSPATH') ) die;
/**
 *
 * Options Framework class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

class Xeroft_Framework extends Xeroft_Framework_Helper {

    /**
    *
    * @access public 
    * @var array 
    *
    */
    public $settings =  array();

    /**
    *
    * @access public 
    * @var array 
    *
    */
    public $sections  =  array();

    /**
    *
    * @access public 
    * @var array 
    *
    */
    public $options =  array();

    /**
    *
    * @access public 
    * @var array 
    *
    */
    public $get_option =  array();

    /**
    *
    * @access private 
    * @var class 
    *
    */
    private static $instance = null;

    /**
    *
    * @access public
    *
    * Constructor Method of Class Xeroft_Framework
    */
    public function __construct( $settings, $options ) {
        $this->settings = apply_filters( 'xeroft_framework_settings', $settings);
        $this->options = apply_filters( 'xeroft_framework_options', $options);

        if ( ! empty($this->options) ) {
            $this->sections   = $this->get_section();
            $this->get_option = get_option( 'xr_options' );
            add_action( 'admin_init', array($this, 'settings_api') );
            add_action( 'admin_menu', array($this, 'admin_menu') );
        }
    }


    public static function instance( $settings = array(), $options = array() ) {
        if ( is_null(self::$instance) ) {
            self::$instance = new self( $settings, $options );
        }
        return self::$instance;
    }

    public function options_validate($input) {
        foreach( $this->sections as $section ) {
            foreach ($section['fields'] as $field) {
                $newinput[$field['id']] = $input[$field['id']];   
            }
        }
        return $newinput; 
    }

    public function get_section() {
        foreach( $this->options as $key => $value ) {
            if ( isset( $value['fields'] ) ) {
                $sections[] = $value;
            }
        }

        return $sections;
    }

    /**
    *
    * Field Type
    * 
    */
    public function field_callback($field) {
        call_user_func( array(&$this, 'add_' . $field['type'] . '_field'), $field );
    }


    public function settings_api() {
        foreach ($this->sections as $section) {
            register_setting( 'xr_options_group', 'xr_options', array(&$this, 'options_validate') );
        
            add_settings_section( $section['name'] . '_section', $section['title'], '', $section['name'] . '_section_group' );
        
            foreach ( $section['fields'] as $field_key => $field ) {
                add_settings_field( $field_key . '_field', '', array(&$this, 'field_callback'), $section['name'] . '_section_group', $section['name'] . '_section', $field );
            }  
        }  
    }

    
    /**
    *
    * Adding Menu Item
    *
    */
    public function admin_menu() {
        $defaults = array(
            'parent_slug' => '',
            'page_title' => '',
            'menu_title' => '',
            'menu_type' => '',
            'menu_slug' => '',
            'capability' => 'manage_options',
            'icon_url'   => '',
            'position'   => null, 
            );

        $args = wp_parse_args( $this->settings, $defaults );
        
        if( $args['menu_type'] == 'submenu' ) {
            call_user_func( 'add_' . $args['menu_type'] . '_page' , $args['parent_slug'], $args['page_title'], $args['menu_title'], $args['capability'], $args['menu_slug'], array( &$this, 'admin_page' ) );
        } else {
            call_user_func( 'add_' . $args['menu_type'] . '_page', $args['page_title'], $args['menu_title'], $args['capability'], $args['menu_slug'], array( &$this, 'admin_page' ) , $args['icon_url'], $args['position'] );
        }
        
    }

    public function admin_page() { ?>
        <div class="wrap">
            <h2>Framework Options</h2>
            <form method="post" action="options.php" enctype="mulipart/form-data">
                <?php 
                settings_fields('xr_options_group');
                foreach ($this->sections as $section) {
                    do_settings_sections( $section['name'] . '_section_group' );
                }
                submit_button( 'Save Changes', 'primary', 'submit' );
                ?>
            </form>
        </div>
    <?php
    }

}


