<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Affiliate_Products
 * @subpackage Affiliate_Products/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Affiliate_Products
 * @subpackage Affiliate_Products/public
 * @author     Developer Junayed <admin@easeare.com>
 */
class Affiliate_Products_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( "affiliate_products", [$this, "products_view"] );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/affiliate-products-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( 'jooslider', plugin_dir_url( __FILE__ ) . 'js/jooslider.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/affiliate-products-public.js', array( 'jooslider' ), $this->version, true );

	}

	// Include competitions archive page
	function products_templates( $template ) {

		if ( is_singular( 'products' )) {
			$theme_files = array('fullwidth-product.php', plugin_dir_path( __FILE__ ).'partials/fullwidth-product.php');
			$exists_in_theme = locate_template($theme_files, false);
			if ( $exists_in_theme != '' ) {
				$template = $exists_in_theme;
			} else {
				$template = plugin_dir_path( __FILE__ ). 'partials/fullwidth-product.php';
			}
		}

		if ($template == '') {
			throw new \Exception('No template found');
		}

		return $template;
	}

	function the_content_products($content){
		if ( is_singular( 'products' )) {
			require_once plugin_dir_path( __FILE__ )."partials/affiliate-products-single.php";
			return get_product_content();
		}else{
			return $content;
		}
	}

	function products_view(){
		ob_start();
		require_once plugin_dir_path( __FILE__ )."partials/affiliate-products.php";
		return ob_get_clean();
	}
}
