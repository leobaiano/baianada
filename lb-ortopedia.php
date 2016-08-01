<?php
	/**
	 * Plugin Name: LB Ortopedia
	 * Plugin URI:
	 * Description: Plugin desenvolvido para o site ortopedir BR
	 * Author: Leo Baiano
	 * Author URI: http://leobaiano.com.br
	 * Version: 1.0.0
	 * License: GPLv2 or later
	 * Text Domain: lb-ortopedia
 	 * Domain Path: /languages/
	 */

	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.


	/**
	 * LB Ortopedia
	 *
	 * @author   Leo Baiano <ljunior2005@gmail.com>
	 */
	class LB_Ortopedia {
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
		protected static $text_domain = 'lb-ortopedia';

		/**
		 * Initialize the plugin
		 */
		private function __construct() {
			// Load plugin text domain
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

			// Load styles and script
			add_action( 'wp_enqueue_scripts', array( $this, 'load_styles_and_scripts' ) );

			// Load Helpers
			add_action( 'init', array( $this, 'load_helper' ) );

			// Create custom fields for users
			add_action( 'init', array( $this, 'create_user_fields' ) );
		}

		/**
		 * Active plugin
		 */
		public static function activate() {
			self::create_roles();
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
		public function load_styles_and_scripts(){
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

		/**
		 * Create user roles
		 */
		public static function create_roles() {
			add_role(
			    'ortopedistas',
			    __( 'Ortopedistas', 'lb-ortopedia' ),
			    array(
			        'read'         => false,
			        'edit_posts'   => false,
			        'delete_posts' => false,
			    )
			);
		}

		/**
		 * Create user custom fields
		 */
		public function create_user_fields() {
			require 'class/lb-profile-extra-fields.php';
			$fields = array(
							array(
									'slug'			=> 'crm',
									'name'			=> __( 'CRM', 'lb-ortopedia' ),
									'description'	=> __( 'Este é o código CRM do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
							array(
									'slug'			=> 'teot',
									'name'			=> __( 'TEOT', 'lb-ortopedia' ),
									'description'	=> __( 'Este é o código TEOT do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
							array(
									'slug'			=> 'cidade',
									'name'			=> __( 'Cidade', 'lb-ortopedia' ),
									'description'	=> '',
									'field'			=> '',
									'values'		=> '',
								),
							array(
									'slug'			=> 'estado',
									'name'			=> __( 'Estado', 'lb-ortopedia' ),
									'description'	=> '',
									'field'			=> 'select',
									'values'		=> array(
															array( 'value' => '', 'name' => 'Selecione' ),
															array( 'value' => 'AC', 'name' => 'Acre' ),
															array( 'value' => 'AL', 'name' => 'Alagoas' ),
															array( 'value' => 'AP', 'name' => 'Amapá' ),
															array( 'value' => 'AM', 'name' => 'Amazonas' ),
															array( 'value' => 'BA', 'name' => 'Bahia' ),
															array( 'value' => 'CE', 'name' => 'Ceará' ),
															array( 'value' => 'DF', 'name' => 'Distrito Federal' ),
															array( 'value' => 'ES', 'name' => 'Espirito Santo' ),
															array( 'value' => 'GO', 'name' => 'Goiás' ),
															array( 'value' => 'MA', 'name' => 'Maranhão' ),
															array( 'value' => 'MS', 'name' => 'Mato Grosso do Sul' ),
															array( 'value' => 'MT', 'name' => 'Mato Grosso' ),
															array( 'value' => 'MG', 'name' => 'Minas Gerais' ),
															array( 'value' => 'PA', 'name' => 'Pará' ),
															array( 'value' => 'PB', 'name' => 'Paraíba' ),
															array( 'value' => 'PR', 'name' => 'Paraná' ),
															array( 'value' => 'PE', 'name' => 'Pernambuco' ),
															array( 'value' => 'PI', 'name' => 'Piauí' ),
															array( 'value' => 'RJ', 'name' => 'Rio de Janeiro' ),
															array( 'value' => 'RN', 'name' => 'Rio Grande do Norte' ),
															array( 'value' => 'RS', 'name' => 'Rio Grande do Sul' ),
															array( 'value' => 'RO', 'name' => 'Rondônia' ),
															array( 'value' => 'RR', 'name' => 'Roraima' ),
															array( 'value' => 'SC', 'name' => 'Santa Catarina' ),
															array( 'value' => 'SP', 'name' => 'São Paulo' ),
															array( 'value' => 'SE', 'name' => 'Sergipe' ),
															array( 'value' => 'AP', 'name' => 'Tocantins' ),
														),
								),
								array(
									'slug'			=> 'bairro',
									'name'			=> __( 'Bairro', 'lb-ortopedia' ),
									'description'	=> __( 'Bairro do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'rua',
									'name'			=> __( 'Rua', 'lb-ortopedia' ),
									'description'	=> __( 'Rua do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'numero',
									'name'			=> __( 'Número', 'lb-ortopedia' ),
									'description'	=> __( 'Número do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'especialidades',
									'name'			=> __( 'Especialidades', 'lb-ortopedia' ),
									'description'	=> __( 'Especialidades do ortopedista', 'lb-ortopedia' ),
									'field'			=> 'select',
									'values'		=> array(
															array( 'value' => '', 'name' => 'Selecione' ),
															array( 'value' => 'Trauma', 'name' => 'Trauma' ),
															array( 'value' => 'Coluna', 'name' => 'Coluna' ),
															array( 'value' => 'Pediatria', 'name' => 'Pediatria' ),
															array( 'value' => 'Onco', 'name' => 'Onco' ),
															array( 'value' => 'Quadril', 'name' => 'Quadril' ),
															array( 'value' => 'Pés', 'name' => 'Pés' ),
															array( 'value' => 'Mão', 'name' => 'Mão' ),
															array( 'value' => 'Ombro', 'name' => 'Ombro' ),
															array( 'value' => 'Cotovelo', 'name' => 'Cotovelo' ),
															array( 'value' => 'Joelhos', 'name' => 'Joelhos' ),
															array( 'value' => 'Tornozelo', 'name' => 'Tornozelo' ),
															array( 'value' => 'Do esporte', 'name' => 'Do esporte' ),
														),
								),
								array(
									'slug'			=> 'telefone',
									'name'			=> __( 'Bairro', 'lb-ortopedia' ),
									'description'	=> __( 'Telefone do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'site',
									'name'			=> __( 'URL do Site', 'lb-ortopedia' ),
									'description'	=> __( 'URL do site do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'blog',
									'name'			=> __( 'URL do blog', 'lb-ortopedia' ),
									'description'	=> __( 'URL do blog do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'facebook',
									'name'			=> __( 'URL do Facebook', 'lb-ortopedia' ),
									'description'	=> __( 'URL do facebook do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'twitter',
									'name'			=> __( 'URL do Twitter', 'lb-ortopedia' ),
									'description'	=> __( 'URL do twitter do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'instagram',
									'name'			=> __( 'URL do Instagram', 'lb-ortopedia' ),
									'description'	=> __( 'URL do instagram do consultorio do ortopedista.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
								array(
									'slug'			=> 'planos',
									'name'			=> __( 'Planos de sáude', 'lb-ortopedia' ),
									'description'	=> __( 'Planos de saúde que são aceitos', 'lb-ortopedia' ),
									'field'			=> 'select',
									'values'		=> array(
															array( 'value' => '', 'name' => 'Selecione' ),
															array( 'value' => 'Bradesco', 'name' => 'Bradesco' ),
															array( 'value' => 'Happy Vida', 'name' => 'Happy Vida' ),
															array( 'value' => 'Sulamerica', 'name' => 'Sulamerica' ),
														),
								),
								array(
									'slug'			=> 'dias_horarios',
									'name'			=> __( 'Dias e horários', 'lb-ortopedia' ),
									'description'	=> __( 'Dias e horários de atendimento.', 'lb-ortopedia' ),
									'field'			=> '',
									'values'		=> '',
								),
						);
			new Lb_Profile_Extra_Fields_Ortopedia( self::$text_domain, $fields );
		}

	} // end class LB_Ortopedia();
	register_activation_hook( __FILE__ , array( 'LB_Ortopedia', 'activate') );
	add_action( 'plugins_loaded', array( 'LB_Ortopedia', 'get_instance' ), 0 );
