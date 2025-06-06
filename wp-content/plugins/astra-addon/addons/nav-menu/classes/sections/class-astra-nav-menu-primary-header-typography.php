<?php
/**
 * Mega Menu Options configurations.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       1.6.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Nav_Menu_Primary_Header_Typography' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Nav_Menu_Primary_Header_Typography extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Mega Menu Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-typography]',
					'default'   => astra_get_option( 'primary-mega-menu-col-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Mega Menu Heading Font', 'astra-addon' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 72,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				// Option: Primary Megamenu Header Menu Font Family.
				array(
					'name'      => 'primary-header-megamenu-heading-font-family',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-typography]',
					'type'      => 'sub-control',
					'section'   => 'section-primary-menu',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'primary-header-megamenu-heading-font-family' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[primary-header-megamenu-heading-font-weight]',
					'priority'  => 45,
				),

				// Option: Primary Megamenu Header Menu Font Size.
				array(
					'name'        => 'primary-header-megamenu-heading-font-size',
					'parent'      => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-typography]',
					'transport'   => 'postMessage',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'type'        => 'sub-control',
					'section'     => 'section-primary-menu',
					'responsive'  => false,
					'default'     => astra_get_option( 'primary-header-megamenu-heading-font-size' ),
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs' => array(
						'px'  => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em'  => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
						'vw'  => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 25,
						),
						'rem' => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 20,
						),
					),
					'priority'    => 45,
				),

				// Option: Primary Megamenu Header Menu Font Weight.
				array(
					'name'              => 'primary-header-megamenu-heading-font-weight',
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-typography]',
					'type'              => 'sub-control',
					'section'           => 'section-primary-menu',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'default'           => astra_get_option( 'primary-header-megamenu-heading-font-weight' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'primary-header-megamenu-heading-font-family',
					'priority'          => 45,
				),

				// Option: Primary Megamenu Header Menu Text Transform.
				array(
					'name'      => 'primary-header-megamenu-heading-text-transform',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-typography]',
					'type'      => 'sub-control',
					'section'   => 'section-primary-menu',
					'control'   => 'ast-select',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'primary-header-megamenu-heading-text-transform' ),
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'priority'  => 45,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Nav_Menu_Primary_Header_Typography();
