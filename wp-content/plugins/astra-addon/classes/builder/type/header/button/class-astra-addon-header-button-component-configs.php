<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.1.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Register Builder Customizer Configurations.
 *
 * @since 3.1.0
 */
class Astra_Addon_Header_Button_Component_Configs extends Astra_Customizer_Config_Base {
	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 3.1.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		return Astra_Addon_Button_Component_Configs::register_configuration( $configurations, 'header', 'section-hb-button-' );
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Addon_Header_Button_Component_Configs();
