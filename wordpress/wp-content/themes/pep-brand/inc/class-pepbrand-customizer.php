<?php
/**
 * Pepbrand_Customizer Class
 * Makes adjustments to Storefront cores Customizer implementation.
 *
 * @author   WooThemes
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Pepbrand_Customizer' ) ) {

class Pepbrand_Customizer {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		global $storefront_version;

		add_action( 'wp_enqueue_scripts',	             array( $this, 'add_customizer_css' ),						1000 );
		add_filter( 'storefront_setting_default_values', array( $this, 'get_pepbrand_defaults' ) );

	}

	/**
	 * Returns an array of the desired default Storefront options
	 * @return array
	 */
	public function get_pepbrand_defaults() {
		return apply_filters( 'pepbrand_default_settings', $args = array(
			

			'storefront_text_color'						=> '#444444',
			'storefront_accent_color'					=> '#333333',
			'background_color'				            => '#ffffff',
			'storefront_heading_color'					=> '#222222',
			
			'storefront_header_background_color'		=> '#ffffff',
			'storefront_header_link_color'				=> '#000000',
			'storefront_header_text_color'				=> '#333333',

			'storefront_button_background_color'		=> '#666666',
			'storefront_button_text_color'				=> '#ffffff',
			'storefront_button_alt_background_color'	=> '#333333',
			'storefront_button_alt_text_color'			=> '#ffffff',

			'storefront_footer_heading_color'			=> '#222222',
			'storefront_footer_background_color'		=> '#ffffff',
			'storefront_footer_link_color'				=> '#000000',
			'storefront_footer_text_color'				=> '#333333',


		) );
	}

	/**
	 * Set default Customizer settings based on Storechild design.
	 * @uses get_pepbrand_defaults()
	 * @return void
	 */
	public function edit_default_customizer_settings( $wp_customize ) {
		foreach ( Pepbrand_Customizer::get_pepbrand_defaults() as $mod => $val ) {
			$setting = $wp_customize->get_setting( $mod );

			if ( is_object( $setting ) ) {
				$setting->default = $val;
			}
		}
	}

	/**
	 * Returns a default theme_mod value if there is none set.
	 * @uses get_pepbrand_defaults()
	 * @return void
	 */
	public function default_theme_mod_values() {
		foreach ( Pepbrand_Customizer::get_pepbrand_defaults() as $mod => $val ) {
			add_filter( 'theme_mod_' . $mod, function( $setting ) use ( $val ) {
				return $setting ? $setting : $val;
			});
		}
	}



	/**
	 * Add CSS using settings obtained from the theme options.
	 * @return void
	 */
	public function add_customizer_css() {
		$header_text_color			= get_theme_mod( 'storefront_header_text_color' );
		$header_link_color			= get_theme_mod( 'storefront_header_link_color' );
		$accent_color				= get_theme_mod( 'storefront_accent_color' );
		$footer_link_color			= get_theme_mod( 'storefront_footer_link_color' );
		$footer_heading_color		= get_theme_mod( 'storefront_footer_heading_color' );
		$footer_text_color			= get_theme_mod( 'storefront_footer_text_color' );
		$button_background_color	= get_theme_mod( 'storefront_button_background_color' );
		$button_text_color			= get_theme_mod( 'storefront_button_text_color' );
		$header_background_color	= get_theme_mod( 'storefront_header_background_color' );

		$darken_factor				= -115;
		$lighten_factor				= 115;
		$style						= '
			.main-navigation ul li:hover > a,
			a.cart-contents:hover,
			.site-header-cart .widget_shopping_cart a:hover,
			.site-footer a:not(.button):hover,
			.site-header-cart:hover > li > a {
				color: ' . storefront_adjust_color_brightness( $header_link_color, 90 ) . ';
			}
			a:hover,
			ul.products li.product h3:hover {
				color: '. storefront_adjust_color_brightness ($accent_color, -100). ';	
			}
			.product_list_widget a:hover {
				color: '. storefront_adjust_color_brightness($accent_color, -90) . ';
			}

			.woocommerce-breadcrumb a:hover {
				color: ' . $header_text_color . ';
			}
			header ::-webkit-input-placeholder,
			.site-search .widget_product_search form:before {
				color: '.$header_text_color.';
			}

			.single-product div.product .summary .price {
				color: ' . $accent_color . ';
			}

			.header-widget-region {
				color: ' . $footer_text_color . ';
			}

			.header-widget-region a:not(.button) {
				color: ' . $footer_link_color . ';
			}


			.header-widget-region h1, .header-widget-region h2, .header-widget-region h3, .header-widget-region h4, .header-widget-region h5, .header-widget-region h6 {
				color: ' . $footer_heading_color . ';
			}

			.main-navigation ul li.smm-active li ul.products li.product h3,
			.main-navigation ul li.smm-active li ul.products li.product .price {
				color: ' . $header_text_color . ';
			}

				.site-header-cart .widget_shopping_cart,
				.main-navigation ul.menu ul.sub-menu,
				.main-navigation ul.nav-menu ul.children {
					background-color: ' . storefront_adjust_color_brightness( $header_background_color, -15 ) . ';
				}
				.site-header {
					border-bottom-color: ' . $header_background_color . ';
				}

			}';

		wp_add_inline_style( 'storefront-child-style', $style );
	}
}
}



return new Pepbrand_Customizer();

