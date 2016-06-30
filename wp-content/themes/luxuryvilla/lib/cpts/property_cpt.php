<?php
if ( ! class_exists( 'Property_Post_Type' ) ) :

class Property_Post_Type {

	public function __construct() {

		// Runs when the plugin is activated
		register_activation_hook( __FILE__, array( &$this, 'plugin_activation' ) );

		// Adds the property post type and taxonomies
		add_action( 'init', array( &$this, 'property_init' ) );

		// Thumbnail support for property posts
		add_theme_support( 'post-thumbnails', array( 'property' ) );

		// Adds columns in the admin view for thumbnail and taxonomies
		add_filter( 'manage_edit-property_cpt_columns', array( &$this, 'property_edit_columns' ), 10, 1 );
		add_action( 'manage_posts_custom_column', array( &$this, 'property_column_display' ), 10, 1 );

		// Allows filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( &$this, 'add_taxonomy_filters' ) );

		// Show property post counts in the dashboard
		add_action( 'right_now_content_table_end', array( &$this, 'add_property_counts' ) );

        // Add taxonomy terms as body classes
        add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	/**
     * Flushes rewrite rules on plugin activation to ensure property posts don't 404.
     *
     * @link http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
     *
     * @uses Property_Post_Type::property_init()
     */
    public function plugin_activation() {
            $this->load_textdomain();
            $this->property_init();
            flush_rewrite_rules();
    }

    /**
     * Initiate registrations of post type and taxonomies.
     *
     * @uses Property_Post_Type::register_post_type()
     * @uses Property_Post_Type::register_taxonomy_tag()
     * @uses Property_Post_Type::register_taxonomy_category()
     */
    public function property_init() {
            $this->register_post_type();
            $this->register_taxonomy_category();
    }

    /**
     * Get an array of all taxonomies this plugin handles.
     *
     * @return array Taxonomy slugs.
     */
    protected function get_taxonomies() {
            return array( 'property_category');
    }

	protected function register_post_type() {

		/**
		 * Enable the property custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */

		$labels = array(
			'name' 				 => __( 'Properties', 'okthemes' ),
			'singular_name' 	 => __( 'Property', 'okthemes' ),
			'add_new' 			 => __( 'Add New Property', 'okthemes' ),
			'add_new_item' 		 => __( 'Add New Property', 'okthemes' ),
			'edit_item' 		 => __( 'Edit Property', 'okthemes' ),
			'new_item' 			 => __( 'New Property', 'okthemes' ),
			'view_item' 		 => __( 'View Property', 'okthemes' ),
			'search_items' 		 => __( 'Search Property', 'okthemes' ),
			'not_found' 		 => __( 'No Properties items found', 'okthemes' ),
			'not_found_in_trash' => __( 'No Properties items found in trash', 'okthemes' )
		);

		$args = array(
	    	'labels' 			=> $labels,
	    	'public' 			=> true,
	    	'show_in_nav_menus' => true,
			'supports' 			=> array( 
					'title',
					'editor', 
					'thumbnail', 
					'revisions' 
			),
			'capability_type' 	=> 'post',
			'rewrite' 			=> array("slug" => 'property'), // Permalinks format
			'hierarchical' 		=> false,
			'has_archive' 		=> true
		); 

		$args = apply_filters( 'propertyposttype_args', $args );

		register_post_type( 'property_cpt', $args );

	}

	/**
     * Register a taxonomy for property Categories.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    protected function register_taxonomy_category() {

	    $labels = array(
			'name' 							=> __( 'Property Categories', 'okthemes' ),
			'singular_name' 				=> __( 'Property Category', 'okthemes' ),
			'search_items' 					=> __( 'Search Property Categories', 'okthemes' ),
			'popular_items' 				=> __( 'Popular Property Categories', 'okthemes' ),
			'all_items' 					=> __( 'All Property Categories', 'okthemes' ),
			'parent_item' 					=> __( 'Parent Property Category', 'okthemes' ),
			'parent_item_colon' 			=> __( 'Parent Property Category:', 'okthemes' ),
			'edit_item' 					=> __( 'Edit Property Category', 'okthemes' ),
			'update_item' 					=> __( 'Update Property Category', 'okthemes' ),
			'add_new_item' 					=> __( 'Add New Property Category', 'okthemes' ),
			'new_item_name' 				=> __( 'New Property Category Name', 'okthemes' ),
			'separate_items_with_commas' 	=> __( 'Separate property categories with commas', 'okthemes' ),
			'add_or_remove_items' 			=> __( 'Add or remove property categories', 'okthemes' ),
			'choose_from_most_used' 		=> __( 'Choose from the most used property categories', 'okthemes' ),
			'menu_name' 					=> __( 'Property Categories', 'okthemes' ),
	    );

	    $args = array(
			'labels' 				=> $labels,
			'public' 				=> true,
			'show_in_nav_menus' 	=> true,
			'show_ui' 				=> true,
			'show_tagcloud' 		=> true,
			'hierarchical' 			=> true,
			'rewrite' 				=> array( 'slug' => 'property_category' ),
			'query_var' 			=> true
	    );

	    $args = apply_filters( 'propertyposttype_category_args', $args );

	    register_taxonomy( 'property_category', array( 'property_cpt' ), $args );

	}

	/**
     * Add taxonomy terms as body classes.
     *
     * If the taxonomy doesn't exist (has been unregistered), then get_the_terms() returns WP_Error, which is checked
     * for before adding classes.
     *
     * @param array $classes Existing body classes.
     *
     * @return array Amended body classes.
     */
    public function add_body_classes( $classes ) {

            // Only single posts should have the taxonomy body classes
            if ( ! is_single() )
                    return $classes;

            $taxonomies = $this->get_taxonomies();
            foreach( $taxonomies as $taxonomy ) {
                    $terms = get_the_terms( get_the_ID(), $taxonomy );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                            foreach( $terms as $term ) {
                                    $classes[] = sanitize_html_class( str_replace( '_', '-', $taxonomy ) . '-' . $term->slug );
                            }
                    }
            }

            return $classes;
    }

	/**
	 * Add Columns to property Edit Screen
	 * http://wptheming.com/2010/07/column-edit-pages/
	 */

	public function property_edit_columns( $columns ) {
		$columns = array(
			"cb"					=> "<input type=\"checkbox\" />",
			"title" 				=> __('Title', 'okthemes'),
			"property_thumbnail" 	=> __('Thumbnail', 'okthemes'),
			"property_category" 	=> __('Category', 'okthemes'),
			"author" 				=> __('Author', 'okthemes'),
			"date" 					=> __('Date', 'okthemes'),
		);

		return $columns;
	}

	public function property_column_display( $column) {

		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		global $post;
		switch ( $column ) {
			
			case 'property_thumbnail':
				$width = (int) 50;
				$height = (int) 50;
				// Display the featured image in the column view if possible
				if ( has_post_thumbnail($post->ID)) {
					the_post_thumbnail(array(50, 50) );
				} else {
					echo 'None';
				}
				break;

			// Display the property tags in the column view
			case "property_category":

				if ( $category_list = get_the_term_list( $post->ID, 'property_category', '', ', ', '' ) ) {
					echo wp_kses_post($category_list);
				} else {
					echo __('None', 'okthemes');
				}
				break;	
			
			/* Just break out of the switch statement for everything else. */
			default :
				break;				
		}
	}

	/**
	 * Adds taxonomy filters to the property admin page
	 * Code artfully lifed from http://pippinsplugins.com
	 */

	public function add_taxonomy_filters() {
		global $typenow;

		// An array of all the taxonomies you want to display. Use the taxonomy name or slug
        $taxonomies = $this->get_taxonomies();

        // Must set this to the post type you want the filter(s) displayed on
        if ( 'property_cpt' != $typenow ) {
                return;
        }

		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			
			if ( 0 == count( $terms ) ) {
                    return;
            }

			echo '<select name="' . esc_attr( $tax_slug ) . '" id="' . esc_attr( $tax_slug ) . '" class="postform">';
            echo '<option value="0">' . esc_html( $tax_name ) .'</option>';
            foreach ( $terms as $term ) {
                    printf(
                            '<option value="%s"%s />%s</option>',
                            esc_attr( $term->slug ),
                            selected( $current_tax_slug, $term->slug ),
                            esc_html( $term->name . '(' . $term->count . ')' )
                    );
            }
            echo '</select>';

		}

	}

	/**
     * Add property count to "Right Now" dashboard widget.
     *
     * @return null Return early if property post type does not exist.
     */
    public function add_property_counts() {
            if ( ! post_type_exists( 'property' ) ) {
                    return;
            }

            $num_posts = wp_count_posts( 'property' );

            // Published items
            $href = 'edit.php?post_type=property';
            $num  = number_format_i18n( $num_posts->publish );
            $num  = $this->link_if_can_edit_posts( $num, $href );
            $text = _n( 'property Item', 'property Items', intval( $num_posts->publish ) );
            $text = $this->link_if_can_edit_posts( $text, $href );
            $this->display_dashboard_count( $num, $text );

            if ( 0 == $num_posts->pending ) {
                    return;
            }

            // Pending items
            $href = 'edit.php?post_status=pending&amp;post_type=property';
            $num  = number_format_i18n( $num_posts->pending );
            $num  = $this->link_if_can_edit_posts( $num, $href );
            $text = _n( 'property Item Pending', 'property Items Pending', intval( $num_posts->pending ) );
            $text = $this->link_if_can_edit_posts( $text, $href );
            $this->display_dashboard_count( $num, $text );
    }

    /**
     * Wrap a dashboard number or text value in a link, if the current user can edit posts.
     *
     * @param  string $value Value to potentially wrap in a link.
     * @param  string $href  Link target.
     *
     * @return string        Value wrapped in a link if current user can edit posts, or original value otherwise.
     */
    protected function link_if_can_edit_posts( $value, $href ) {
            if ( current_user_can( 'edit_posts' ) ) {
                    return '<a href="' . esc_url( $href ) . '">' . $value . '</a>';
            }
            return $value;
    }

    /**
     * Display a number and text with table row and cell markup for the dashboard counters.
     *
     * @param  string $number Number to display. May be wrapped in a link.
     * @param  string $label  Text to display. May be wrapped in a link.
     */
    protected function display_dashboard_count( $number, $label ) {
            ?>
            <tr>
                    <td class="first b b-property"><?php echo esc_html($number); ?></td>
                    <td class="t property"><?php echo esc_html($label); ?></td>
            </tr>
            <?php
    }   

}

new Property_Post_Type;

endif;
?>