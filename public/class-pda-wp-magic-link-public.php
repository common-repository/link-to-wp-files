<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.buildwps.com/prevent-direct-access-premium-plugin/?utm_source=user-website&utm_medium=pluginpage&utm_campaign=plugin-author-link
 * @since      1.0.0
 *
 * @package    Pda_Link_To_Wp_File
 * @subpackage Pda_Link_To_Wp_File/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pda_Link_To_Wp_File
 * @subpackage Pda_Link_To_Wp_File/public
 * @author     buildwps <hello@ymese.com>
 */
class Pda_Link_To_Wp_File_Public {

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
		 * defined in Pda_Link_To_Wp_File_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pda_Link_To_Wp_File_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pda-wp-magic-link-public.css', array(), $this->version, 'all' );

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
		 * defined in Pda_Link_To_Wp_File_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pda_Link_To_Wp_File_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pda-wp-magic-link-public.js', array( 'jquery' ), $this->version, false );

	}

	function get_link_image( $atts, $item, $args ) {
		$url_link = new Pda_Link_To_Wp_File_Databases;
	    $img_id = $item->object_id;
	    $url = $url_link->get_url_by_id($img_id);
	    if("Image Name" == $item->type_label) {
	    	$atts['href'] = $url[0]->guid;
	    }
	    return $atts;
	}

}
