<?php
	/**
	 * Plugin Name: Baianada
	 * Plugin URI:
	 * Description: Based project to create plugins for WordPress
	 * Author: leobaiano
	 * Author URI: http://leobaiano.com.br
	 * Version: 1.0.0
	 * License: GPLv2 or later
	 * Text Domain: lb-baianada
 	 * Domain Path: /languages/
	 */

	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.

	/**
	 * Baianada
	 *
	 * @author   Leo Baiano <ljunior2005@gmail.com>
	 */
	class Baianada {
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Slug.
		 *
		 * @var string
		 */
		protected static $text_domain = 'lb-baianada';

		/**
		 * Initialize the plugin
		 */
		private function __construct() {
			// Load plugin text domain
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

			// Load styles and script
			add_action( 'wp_enqueue_scripts', array( $this, 'load_admin_styles_and_scripts' ) );

			// Load Helpers
			add_action( 'init', array( $this, 'load_helper' ) );
		}

		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( self::$text_domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Load styles and scripts
		 *
		 */
		public function load_admin_styles_and_scripts(){
			wp_enqueue_style( self::$text_domain . '_css_main', plugins_url( '/assets/css/main.css', __FILE__ ), array(), null, 'all' );
			$params = array(
						'ajax_url'	=> admin_url( 'admin-ajax.php' )
					);
			wp_enqueue_script( self::$text_domain . '_js_main', plugins_url( '/assets/js/main.js', __FILE__ ), array( 'jquery' ), null, true );
			wp_localize_script( self::$text_domain . '_js_main', 'data_brodinhos', $params );
		}

		/**
		 * Load auxiliary and third classes are in the class directory
		 *
		 */
		public function load_helper() {
			$class_dir = plugin_dir_path( __FILE__ ) . "/helper/";
			foreach ( glob( $class_dir . "*.php" ) as $filename ){
				include $filename;
			}
		}

	} // end class Baianada();

	add_action( 'plugins_loaded', array( 'Baianada', 'get_instance' ), 0 );
