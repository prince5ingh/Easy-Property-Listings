<?php
/**
 * WIDGET :: Listing Search Commercial
 *
 * @package     EPL
 * @subpackage  Widget/Search/Commercial
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * EPL_Widget_Listing_Search_Commercial class
 *
 * @since 1.0
 */
class EPL_Widget_Listing_Search_Commercial extends WP_Widget {

	function __construct() {
		parent::__construct( false, $name = __('EPL - Listing Search Commercial', 'easy-property-listings'), array( 'description' => __( 'Listing Search Commercial.', 'easy-property-listings' ) ) );
	}

	function widget($args, $instance) {

		$defaults = epl_listing_search_commercial_get_defaults();
		$instance = wp_parse_args( (array) $instance, $defaults );

		extract( $args );

		echo $before_widget;

		$title	= apply_filters('widget_title', $instance['title']);

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo epl_shortcode_listing_search_commercial_callback($instance);

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance 	= $old_instance;
		$all_fields = epl_listing_search_commercial_widget_fields();
		foreach($all_fields as $all_field) {
			$instance[$all_field['key']] = epl_strip_tags($new_instance[$all_field['key']]);
		}
		return $instance;
	}

	function form($instance) {

		$defaults 			= epl_listing_search_commercial_get_defaults();
		$instance 			= wp_parse_args( (array) $instance, $defaults );
		$instance 			= array_map('epl_esc_attr',$instance);
		extract($instance);
		$post_types			= $post_type;
		$fields 			= epl_listing_search_commercial_widget_fields();

		foreach($fields as $field) {
			$field_value	=	${$field['key']};
			epl_widget_render_backend_field($field,$this,$field_value);
		}
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("EPL_Widget_Listing_Search_Commercial");') );