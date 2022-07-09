<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Affiliate_Products
 * @subpackage Affiliate_Products/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Affiliate_Products
 * @subpackage Affiliate_Products/admin
 * @author     Developer Junayed <admin@easeare.com>
 */
class Affiliate_Products_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Affiliate_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Affiliate_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/affiliate-products-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Affiliate_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Affiliate_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/affiliate-products-admin.js', array( 'jquery' ), $this->version, false );

	}

	function affiliate_products_post_type() {
		$labels = array(
			'name'                => _x( 'Products', 'Post Type General Name', 'affiliate-products' ),
			'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'affiliate-products' ),
			'menu_name'           => __( 'Products', 'affiliate-products' ),
			'parent_item_colon'   => __( 'Parent Product', 'affiliate-products' ),
			'all_items'           => __( 'All Products', 'affiliate-products' ),
			'view_item'           => __( 'View Product', 'affiliate-products' ),
			'add_new_item'        => __( 'Add New Product', 'affiliate-products' ),
			'add_new'             => __( 'Add New', 'affiliate-products' ),
			'edit_item'           => __( 'Edit Product', 'affiliate-products' ),
			'update_item'         => __( 'Update Product', 'affiliate-products' ),
			'search_items'        => __( 'Search Product', 'affiliate-products' ),
			'not_found'           => __( 'Not Found', 'affiliate-products' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'affiliate-products' ),
		);

		$args = array(
			'label'               => __( 'Products', 'affiliate-products' ),
			'description'         => __( 'Product news and reviews', 'affiliate-products' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 45,
			'menu_icon'       	  => 'dashicons-share-alt2',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' 		  => false,
		);
		
		register_post_type( 'products', $args );

		$labels = array(
			'name'                       => _x( 'Categories', 'taxonomy general name', 'affiliate-products' ),
			'singular_name'              => _x( 'Category', 'taxonomy singular name', 'affiliate-products' ),
			'search_items'               => __( 'Search Categories', 'affiliate-products' ),
			'popular_items'              => __( 'Popular Categories', 'affiliate-products' ),
			'all_items'                  => __( 'All Categories', 'affiliate-products' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Category', 'affiliate-products' ),
			'update_item'                => __( 'Update Category', 'affiliate-products' ),
			'add_new_item'               => __( 'Add New Category', 'affiliate-products' ),
			'new_item_name'              => __( 'New Category Name', 'affiliate-products' ),
			'separate_items_with_commas' => __( 'Separate writers with commas', 'affiliate-products' ),
			'add_or_remove_items'        => __( 'Add or remove writers', 'affiliate-products' ),
			'choose_from_most_used'      => __( 'Choose from the most used writers', 'affiliate-products' ),
			'not_found'                  => __( 'No writers found.', 'affiliate-products' ),
			'menu_name'                  => __( 'Categories', 'affiliate-products' ),
		);
	 
		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'product_apcat' ),
		);
	 
		register_taxonomy( 'product_apcat', 'products', $args );

		if(get_option( 'affproducts_permalinks_flush' ) !== $this->version ){
			flush_rewrite_rules(false);
			update_option( 'affproducts_permalinks_flush', $this->version );
		}
	}
	
	// Remove Quick edit
	function remove_quick_edit_products( $actions, $post ) {
		if(get_post_type( $post ) === 'products'){
			unset($actions['inline hide-if-no-js']);
			return $actions;
		}else{
			return $actions;
		}
	}

	//   Remove edit option from bulk
	function remove_products_edit_actions( $actions ){
		unset( $actions['edit'] );
		return $actions;
	}
	
	// Manage table columns
	function manage_products_columns($columns) {
		unset($columns['categories']);
		unset($columns['date']);

		$columns['title'] = __('Product Title', 'affiliate-products');
		$columns['lowest_price'] = __('Lowest price', 'affiliate-products');
		$columns['ratting'] = __('Ratting', 'affiliate-products');
		$columns['date'] = __('Date', 'affiliate-products');
	
		return $columns;
	}

	// View custom column data
	function manage_products_columns_views($column_id, $post_id){
		switch ($column_id) {
			case 'lowest_price':
				$links = get_post_meta(get_the_ID(), 'affiliate_links', true);
				$links = ((is_array($links)) ? array_values($links): []);
				$minArr = array_column($links, 'current_price');
				$minprice = ((sizeof($minArr) > 0) ? min($minArr): 0);
				echo '$'.$minprice;
				break;
			case 'ratting':
				$ratings = get_post_meta(get_the_ID(), 'product_rating', true);
				echo get_product_ratings($ratings);
				break;
		}
	}

	function products_metaboxes(){
		add_meta_box( 'gallerydiv', "Product gallery", [$this, 'post_gallery_box'], 'products', 'side' );
		add_meta_box( 'wheretobuydiv', "Where to buy", [$this, 'where_tobuy_box'], 'products', 'advanced' );
		add_meta_box( 'avgratingkdiv', "Rating", [$this, 'rating_box'], 'products', 'side' );
	}

	function post_gallery_box($post){
		?>
		<div id="gallery__items">
			<ul>
				<?php
				$gallleries = get_post_meta($post->ID, 'product_galleries', true);
				if(is_array($gallleries)){
					foreach($gallleries as $gallery){
						?>
						<li> 
							<img src="<?php echo wp_get_attachment_url( intval($gallery) ) ?>">
							<input type="hidden" name="product_galleries[]" value="<?php echo $gallery ?>">
							<span class="delete__gallery">+</span>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
		<p class="addgallerybtn">
			<a href="#" id="add__gallery_images">Add product gallery images</a>
		</p>
		<?php
	}

	function where_tobuy_box($post){
		?>
		<div id="wheretobuy_box">
			<div id="afflinks" class="afflinks">
				<ul>
				<?php
				$links = get_post_meta($post->ID, 'affiliate_links', true);
				if(is_array($links)){
					foreach($links as $key => $link){
						$category = ((array_key_exists('category', $link)) ? $link['category']: '');
						$logo = ((array_key_exists('logo', $link)) ? $link['logo']: '');
						$oprice = ((array_key_exists('original_price', $link)) ? $link['original_price']: '');
						$price = ((array_key_exists('current_price', $link)) ? $link['current_price']: '');
						$afflink = ((array_key_exists('affiliate_link', $link)) ? $link['affiliate_link']: '');
						?>
						<li> 
							<span class="delete_link">+</span> 
							<div class="fitem"> 
								<label for="cat-<?php echo $key ?>"> Category</label> 
								<select id="cat-<?php echo $key ?>" name="aff_links[<?php echo $key ?>][category]"> 
									<option <?php echo (($category === 'men') ? 'selected': '') ?> value="men">Men</option> 
									<option <?php echo (($category === 'women') ? 'selected': '') ?> value="women">Women</option> 
								</select> 
							</div> 
							<div class="fitem"> 
								<label>Logo</label> 
								<button class="button-secondary upload__link_logo">Upload</button> 
								<input type="hidden" name="aff_links[<?php echo $key ?>][logo]" value="<?php echo $logo ?>"> 
								<div class="logo_preview"> <img src="<?php echo $logo ?>"></div> 
							</div> 
							<div class="fitem"> 
								<label for="oprice-<?php echo $key ?>">Highest price</label> 
								<input id="oprice-<?php echo $key ?>" type="number" name="aff_links[<?php echo $key ?>][original_price]" value="<?php echo $oprice ?>"> 
							</div> 
							<div class="fitem"> 
								<label for="cprice-<?php echo $key ?>">Lowest price</label> 
								<input id="cprice-<?php echo $key ?>" type="number" name="aff_links[<?php echo $key ?>][current_price]" value="<?php echo $price ?>"> 
							</div> 
							<div class="fitem"> 
								<label for="link-<?php echo $key ?>">Affiliate Link</label> 
								<input id="link-<?php echo $key ?>" type="url" name="aff_links[<?php echo $key ?>][affiliate_link]" value="<?php echo $afflink ?>"> 
							</div> 
						</li>
						<?php
					}
				}
				?>
				</ul>
			</div>
			<button id="add_link" class="button-primary">Add Link</button>
		</div>
		<?php
	}

	function rating_box($post){
		$rate = get_post_meta($post->ID, 'product_rating', true);
		echo '<input type="number" name="product_rating" class="widefat" value="'.$rate.'" min="0" max="5">';
	}

	function save_post_products_meta($post_id){
		update_post_meta( $post_id, 'product_galleries', ((isset($_POST['product_galleries'])) ? $_POST['product_galleries'] : '') );
		update_post_meta( $post_id, 'affiliate_links', ((isset($_POST['aff_links'])) ? $_POST['aff_links'] : '') );
		update_post_meta( $post_id, 'product_rating', ((isset($_POST['product_rating'])) ? $_POST['product_rating'] : '') );
	}

	function admin_menu_page(){
		add_submenu_page( "edit.php?post_type=products", "Shortcode", "Shortcode", "manage_options", "products", [$this, "products_settings_callback"], null );
		add_settings_section( 'products_opt_section', '', '', 'products_opt_page' );
		// Shortcode
		add_settings_field( 'products_shortcode', 'Products Shortcode', [$this, 'products_shortcode_cb'], 'products_opt_page','products_opt_section' );
	}

	function products_shortcode_cb(){
		echo '<input type="text" readonly value="[affiliate_products]">';
	}

	function products_settings_callback(){
		require_once plugin_dir_path( __FILE__ )."partials/affiliate-products-admin-display.php";
	}
	
}
