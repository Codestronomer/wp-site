<?php
/**
 * Post Condition Handler.
 */

namespace PremiumAddons\Includes\PA_Display_Conditions\Conditions;

// Elementor Classes.
use Elementor\Controls_Manager;

// PA Classes.
use PremiumAddons\Includes\Helper_Functions;
use PremiumAddons\Includes\Controls\Premium_Post_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Post
 */
class Post extends Condition {

	/**
	 * Get Controls Options.
	 *
	 * @access public
	 * @since 4.7.0
	 *
	 * @return array|void  controls options
	 */
	public function get_control_options() {

		return array(
			'label'         => __( 'Value', 'premium-addons-pro' ),
			'type'          => Premium_Post_Filter::TYPE,
			'label_block'   => true,
			'multiple'      => true,
			'source'        => 'post',
			'condition'   => array(
				'pa_condition_key' => 'post',
			),
		);

	}

	/**
	 * Compare Condition Value.
	 *
	 * @access public
	 * @since 4.7.0
	 *
	 * @param array       $settings       element settings.
	 * @param string      $operator       condition operator.
	 * @param string      $value          condition value.
	 * @param string      $compare_val    compare value.
	 * @param string|bool $tz        time zone.
	 *
	 * @return bool|void
	 */
	public function compare_value( $settings, $operator, $value, $compare_val, $tz ) {

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $index => $post_id ) {

				if ( is_single( $post_id ) || is_singular( $post_id ) ) {
					return Helper_Functions::get_final_result( true, $operator );
				}
			}
		}

		return false;
	}
}
