<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Elementor_Custom_Widget
 * @subpackage Elementor_Custom_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Elementor_Custom_Widget
 * @subpackage Elementor_Custom_Widget/admin
 * @author     Melberth <melberthbontilao@gmail.com>
 */

class Elementor_Custom_Widget_Register {
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {

        // Register widget scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

        // Register widgets
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

        // Register editor scripts
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

        // 
        add_action('acf/init', [ $this, 'acf_add_local_field_groups' ] );

    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts() {
        wp_register_script( 'elementor-custom-widget', plugins_url( '/js/elementor-custom-widget.js', __FILE__ ), [ 'jquery' ], false, true );
    }

    /**
     * Editor scripts
     *
     * Enqueue plugin javascripts integrations for Elementor editor.
     *
     * @since 1.2.1
     * @access public
     */
    public function editor_scripts() {
        add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

        wp_enqueue_script(
            'elementor-custom-widget-editor',
            plugins_url( '/js/editor/editor.js', __FILE__ ),
            [
                'elementor-editor',
            ],
            '1.2.1',
            true
        );
    }

    /**
     * Force load editor script as a module
     *
     * @since 1.2.1
     *
     * @param string $tag
     * @param string $handle
     *
     * @return string
     */
    public function editor_scripts_as_a_module( $tag, $handle ) {
        if ( 'elementor-custom-widget-editor' === $handle ) {
            $tag = str_replace( '<script', '<script type="module"', $tag );
        }

        return $tag;
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     *
     * @param Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets( $widgets_manager ) {
        // Its is now safe to include Widgets files
        require_once( __DIR__ . '/widgets/custom-widget.php' );

        // Register Widgets
        $widgets_manager->register( new \Elementor_Custom_Element_Widget() );
    }

    /**
     * Create ACF fields
     * 
     * ACF fields
     * */
    public function acf_add_local_field_groups() {
        acf_add_local_field_group(array(
            'key' => 'group_1',
            'title' => 'Elementor Custom Widget Fields',
            'fields' => array(
                array(
                    'key' => 'widget_field_text',
                    'label' => 'Widget Text',
                    'name' => 'widget_text',
                    'type' => 'text',
                ),
                array(
                    'key' => 'widget_repeater_field',
                    'label' => 'Widget Repeater Fields',
                    'name' => 'widget_repeater',
                    'type' => 'repeater',
                    'layout'            => 'table',
                    'button_label'      => 'Add new repeater row',
                    'sub_fields' => array(
                        array(
                            'key' => 'sub_widget_field_text',
                            'label' => 'Repeater Textarea Field',
                            'name' => 'sub_widget_textarea',
                            'type' => 'textarea'
                        ),
                        array(
                            'key' => 'sub_widget_field_image',
                            'label' => 'Repeater Image Field',
                            'name' => 'sub_widget_image',
                            'type' => 'image'
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                    ),
                ),
            ),
        ));
    }
}

// Instantiate Plugin Class
Elementor_Custom_Widget_Register::instance();