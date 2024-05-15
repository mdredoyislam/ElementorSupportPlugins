<?php
/**
 * Plugin Name: Elementor Pricing Adons
 * Description: Custom Elementor extension which includes custom widgets.
 * Plugin URI:  https://redoyislam.xyz/prichingadons
 * Version:     1.0.0
 * Author:      MD REDOY ISLAM
 * Author URI:  https://redoyislam.xyz
 * Text Domain: pricingadons
 * Domain Path: /languages
 */
use \Elementor\Plugin as Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	die( __("Direct Access is Not allowed", "pricingadons") );
}

final class ElementorPricingAddons {

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function i18n() {

		load_plugin_textdomain( 'pricingadons', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

	}

	public function init() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
		add_action('elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );
		add_action('elementor/editor/after_enqueue_scripts', [ $this, 'pricing_editor_assets' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		add_action( 'elementor/elements/categories_registered', [ $this, 'elementor_pricing_category' ] );

	}
	// Custom CSS
	public function widget_styles() {

		wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');
		wp_enqueue_style( 'froala', '//cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css');
		wp_enqueue_style('plugin-main', plugins_url( '/assets/css/style.css', __FILE__ ));

	}
	//Custom JS
	public function widget_scripts(){
		wp_enqueue_script('progress-bar', plugins_url( '/assets/js/progressbar.min.js', __FILE__ ), null, time(), true);
		wp_enqueue_script('progress-helper', plugins_url( '/assets/js/script.js', __FILE__ ), array('jquery'), time(), true);
	}
	// Custom JS
	public function pricing_editor_assets() {
		wp_enqueue_script('pricing_editor_assets', plugins_url( '/assets/js/main.js', __FILE__ ), array('jquery'), time(), true);
	}

	public function init_widgets() {

		require_once( __DIR__ . '/widgets/pricing-widgets.php' );
		require_once( __DIR__ . '/widgets/progressbar-widgets.php' );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \pricingWidget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \progressbargWidget() );

	}

	public function elementor_pricing_category () {

		\Elementor\Plugin::$instance->elements_manager->add_category( 
			'pricing-category',
			[
				'title' => __( 'Pricing Options', 'pricingadons' ),
				'icon' => 'fa fa-table', //default icon
			]
		);
	
	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pricingadons' ),
			'<strong>' . esc_html__( 'Picchi Elementor Extension', 'pricingadons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pricingadons' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pricingadons' ),
			'<strong>' . esc_html__( 'Picchi Elementor Extension', 'pricingadons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pricingadons' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pricingadons' ),
			'<strong>' . esc_html__( 'Picchi Elementor Extension', 'pricingadons' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pricingadons' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
}
ElementorPricingAddons::instance();