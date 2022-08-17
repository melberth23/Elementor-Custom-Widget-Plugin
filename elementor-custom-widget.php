<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Elementor_Custom_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       Elementor custom widget
 * Plugin URI:        #
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Melberth
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       elementor-custom-widget
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
define( 'ELEMENTOR_CUSTOM_WIDGET_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elementor-custom-widget-activator.php
 */
function activate_elementor_custom_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elementor-custom-widget-activator.php';
	Elementor_Custom_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elementor-custom-widget-deactivator.php
 */
function deactivate_elementor_custom_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elementor-custom-widget-deactivator.php';
	Elementor_Custom_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_elementor_custom_widget' );
register_deactivation_hook( __FILE__, 'deactivate_elementor_custom_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-elementor-custom-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elementor_custom_widget() {

	$plugin = new Elementor_Custom_Widget();
	$plugin->run();

}
run_elementor_custom_widget();
