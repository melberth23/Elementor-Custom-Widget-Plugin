<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Custom Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Custom_Element_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Custom widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Custom Widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Custom widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Custom Widget', 'elementor-custom-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Custom widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Custom widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Custom widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'custom widget' ];
	}

	/**
	 * Render Custom widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$widget_text = get_field( 'widget_text' );

		if(!empty($widget_text)) {
			echo '<div class="custom-elementor-widget-text">';
			echo "Widget Text Value: ". $widget_text;
			echo '</div>';
		}

		$this->display_repeater_fields();

	}

	public function display_repeater_fields() {
		$size = 'full';

		if( have_rows('repeater_field_name') ):
		    while( have_rows('repeater_field_name') ) : the_row();

		        $sub_widget_textarea = get_sub_field('sub_widget_textarea');
		        $sub_widget_image = get_sub_field('sub_widget_image');

		        if(!empty($sub_widget_textarea)) {
			        echo '<div class="custom-elementor-widget-textarea">';
					echo "Widget Textarea Value: ". $sub_widget_textarea;
					echo '</div>';
		        }

		        if(!empty($sub_widget_image)) {
			        echo '<div class="custom-elementor-widget-textarea">';
					echo wp_get_attachment_image( $sub_widget_image, $size );
					echo '</div>';
		        }

		    // End loop.
		    endwhile;
		endif;
	}

}