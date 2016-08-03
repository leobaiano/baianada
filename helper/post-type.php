<?php
	/**
	 * LB Post Type
	 *
	 * @author   Leo Baiano <ljunior2005@gmail.com>
	 */

	class LB_Post_Type {

		/**
		 * Slug.
		 *
		 * @var string
		 */
		private $slug;

		/**
		 * Name.
		 *
		 * @var string
		 */
		private $name;

		/**
		 * Supports.
		 *
		 * @var array
		 */
		private $supports;

		/**
		 * Domain.
		 *
		 * @var string
		 */
		private $domain;

		public function __construct( $slug, $name, $supports, $domain ) {
			$this->slug = $slug;
			$this->name = $name;
			$this->supports = $supports;
			$this->domain = $domain;
			$this->create_cpt();
		}

		public function create_cpt() {

			$labels = array(
				'name' => __( $this->name, $this->domain ),
				'singular_name' => __( $this->name, $this->domain ),
				'add_new' => __( 'Adicionar novo', $this->domain ),
				'add_new_item' => __( 'Adicionar novo', $this->domain ),
				'edit_item' => __( 'Editar item', $this->domain ),
				'new_item' => __( 'Novo item', $this->domain ),
				'view_item' => __( 'Ver item', $this->domain ),
				'search_items' => __( 'Procurar itens', $this->domain ),
				'not_found' => __( 'Nenhum item encontrado', $this->domain ),
				'not_found_in_trash' => __( 'Nenhum item encontrado na lixeira', $this->domain ),
				'parent_item_colon' => __( 'Pai:', $this->domain ),
				'menu_name' => __( $this->name, $this->domain ),
			);

			// Define o comportamento
			$args = array(
				'labels' => $labels,
				'hierarchical' => false,
				'supports' => $this->supports,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'has_archive' => true,
				'query_var' => true,
				'can_export' => true,
				'rewrite' => array(
					'slug' => $this->slug,
					'with_front' => false,
					'feeds' => true,
					'pages' => true
				),
				'capability_type' => 'post'
			);
			register_post_type( $this->slug, $args );
		}
	}
