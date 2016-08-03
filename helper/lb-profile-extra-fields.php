<?php
	/**
	 * Plugin Name: LB Profile Extra Fields
	 * Plugin URI:
	 * Description: Create Extra Fields in Profile
	 * Author: leobaiano
	 * Author URI: https://profiles.wordpress.org/leobaiano/
	 * Version: 0.0.1
	 * License: GPLv2 or later
	 * Text Domain: lb_profile_extra_fields
 	 * Domain Path: /languages/
	 */
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.

	/**
	 * LB Profile Extra Fields
	 *
	 * @author   Leo Baiano <leobaiano@lbideias.com.br>
	 */
	class Lb_Profile_Extra_Fields {

		/**
		 * Pluglin Slug
		 * @var string
		 */
		public static $plugin_slug = '';

		/**
		 * Custom fields
		 * $fields = array(
		 *				array(
		 *						'slug' => '',
		 *						'name' => '',
		 *						'description' => '',
		 *					)
		 *				);
		 * @var array
		 */
		public $custom_fields = array();


		/**
		 * Initialize the plugin
		 */
		public function __construct( $plugin_slug, $custom_fields ) {

			self::$plugin_slug = $plugin_slug;
			$this->custom_fields = $custom_fields;

			// Include extra fields in profile
			add_action( 'show_user_profile', array( $this, 'show_extra_profile_fields' ) );
			add_action( 'edit_user_profile', array( $this, 'show_extra_profile_fields' ) );

			// Save and edit extra fields in profile
			add_action( 'personal_options_update', array( $this, 'save_extra_profile_fields' ) );
			add_action( 'edit_user_profile_update', array( $this, 'save_extra_profile_fields' ) );

		}

		/**
		 * Show extra fields in profile
		 * @param  [type] $user [description]
		 * @return [type]       [description]
		 */
		public function show_extra_profile_fields( $user ) {
			echo '<h3>' . __( 'Informação extra', self::$plugin_slug ) . '</h3>';
			echo '<table class="form-table">';
				foreach ( $this->custom_fields as $field )
					echo $this->generate_extra_fields( $field['slug'], $field['name'], $field['description'], $user, $field['field'], $field['values'] );
			echo '</table>';
		}

		/**
		 * Update extra information user profile
		 * @param  int $user_id 	User ID
		 */
		public function save_extra_profile_fields( $user_id ) {
			if ( !current_user_can( 'edit_user', $user_id ) )
				return false;


			foreach ( $this->custom_fields as $field ) {
				update_usermeta( $user_id, $field['slug'], $_POST[$field['slug']] );
			}
		}

		/**
		 * Function genarate fields for profile
		 * @param  string $slug        Slug field
		 * @param  string $name        Name field
		 * @param  string $description Description field
		 * @param	object $user 		Object with user information
		 * @return string              fields
		 */
		public function generate_extra_fields( $slug, $name, $description, $user, $field = null, $values = null ) {
			$response = '';
			$response .= '<tr>';
					$response .= '<th><label for="' . __( $slug, self::$plugin_slug ) . '">' . __( $name, self::$plugin_slug ) . '</label></th>';

					$response .= '<td>';
							if( empty( $field ) || empty( $values ) ) {
								$response .= '<input type="text" name="' . __( $slug, self::$plugin_slug ) . '" id="' . __( $slug, self::$plugin_slug ) . '" value="' . esc_attr( get_the_author_meta( $slug, $user->ID ) ) . '" class="regular-text" /><br />';
							} else if ( $field == 'select' ) {
									$response .= '<select name="' . __( $slug, self::$plugin_slug ) . '">';
										foreach( $values as $value ) {
											$val = esc_attr( get_the_author_meta( $slug, $user->ID ) );
											$selected = selected( $val, $value['value'], false );
											$response .= '<option value="' . $value['value'] . '" ' . $selected . '>' . $value['name'] . '</option>';
										}
									$response .= '</select>';
							}
						$response .= '<span class="description">' . __( $description, self::$plugin_slug ) . '</span>';
					$response .= '</td>';
				$response .= '</tr>';
			return $response;
		}
	} // End Class Lb_Profile_Extra_Fields
add_action( 'plugins_loaded', array( 'Lb_Profile_Extra_Fields', 'get_instance' ), 0 );
