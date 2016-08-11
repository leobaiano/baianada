<?php
/**
 * Plugin Name: Splinter
 * Plugin URI:
 * Description: Splinter is a WordPress plugin that adds a complete system to your site management courses.
 * Author: Leo Baiano
 * Author URI: http://lbideias.com.br
 * Version: 1.0.0
 * License: GPLv2 or later
 * Text Domain: lb-splinter
	 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly.

if ( ! class_exists( 'Splinter' ) ) :
	/**
	 * Splinter
	 *
	 * @since 1.0.0
	 *
	 * @author   Leo Baiano <ljunior2005@gmail.com>
	 */
	class Splinter {
		/**
		 * Instance of this class.
		 *
		 * @since 1.0.0
	 	 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Slug.
		 *
		 * @since 1.0.0
	 	 *
		 * @var string
		 */
		protected static $text_domain = 'lb-splinter';

		/**
		 * Initialize the plugin
		 */
		private function __construct() {
			// Load plugin text domain
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

			// Load styles and script
			add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_styles_and_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'load_styles_and_scripts' ) );

			// Load Helpers
			add_action( 'init', array( $this, 'load_helper' ) );

			// Create CPT`s
			add_action( 'init', array( $this, 'create_cpts' ) );
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
		 * Load styles and scripts ADMIN
		 *
		 */
		public function load_admin_styles_and_scripts(){
			wp_enqueue_style( self::$text_domain . '_css_main', plugins_url( '/assets/css/admin_main.css', __FILE__ ), array(), null, 'all' );
			$params = array(
						'ajax_url'	=> admin_url( 'admin-ajax.php' )
					);
			wp_enqueue_script( self::$text_domain . '_js_main', plugins_url( '/assets/js/admin_main.js', __FILE__ ), array( 'jquery' ), null, true );
			wp_localize_script( self::$text_domain . '_js_main', 'data_baianada', $params );
		}

		/**
		 * Load styles and scripts
		 *
		 */
		public function load_styles_and_scripts(){
			wp_enqueue_style( self::$text_domain . '_css_main', plugins_url( '/assets/css/main.css', __FILE__ ), array(), null, 'all' );
			$params = array(
						'ajax_url'	=> admin_url( 'admin-ajax.php' )
					);
			wp_enqueue_script( self::$text_domain . '_js_main', plugins_url( '/assets/js/main.js', __FILE__ ), array( 'jquery' ), null, true );
			wp_localize_script( self::$text_domain . '_js_main', 'data_baianada', $params );
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

		/**
		* Create CPT`s
		*
		*/
		public function create_cpts() {

			// CPT Course
			new LB_Post_Type_Splinter( 'course', 'Courses', array( 'title', 'excerpt', 'editor', 'thumbnail' ), self::$text_domain );

			// CPT Modules
			new LB_Post_Type_Splinter( 'module', 'Modules', array( 'title', 'excerpt', 'editor', 'thumbnail' ), self::$text_domain );

			// CPT Lessons
			new LB_Post_Type_Splinter( 'lesson', 'Lessons', array( 'title', 'excerpt', 'editor', 'thumbnail' ), self::$text_domain );

			// CPT Teacher
			new LB_Post_Type_Splinter( 'teacher', 'Teachers', array( 'title', 'excerpt', 'editor', 'thumbnail' ), self::$text_domain );

			// CPT Classes
			new LB_Post_Type_Splinter( 'lesson', 'Lessons', array( 'title', 'excerpt', 'editor', 'thumbnail' ), self::$text_domain );

		}

	} // end class Baianada();
	add_action( 'plugins_loaded', array( 'Splinter', 'get_instance' ), 0 );
endif;
