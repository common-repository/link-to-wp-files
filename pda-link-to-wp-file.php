<?php

/**
 *
 *
 * @link              www.buildwps.com/prevent-direct-access-premium-plugin/?utm_source=user-website&utm_medium=pluginpage&utm_campaign=plugin-author-link
 * @since             1.0.2
 * @package           Pda_Link_To_Wp_Files
 *
 * @wordpress-plugin
 * Plugin Name:       Link to WordPress Files
 * Plugin URI:        www.buildwps.com
 * Description:       Linking to WordPress Media files is never easier with Link to WordPress Files.
 * Version:           1.0.2
 * Author:            ProFaceOff
 * Author URI:        https://www.profaceoff.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pda-link-to-wp-files
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LINK_TO_WP_FILE', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pda-link-to-wp-file-activator.php
 */
function activate_pda_wp_link_to_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pda-link-to-wp-file-activator.php';
	Pda_Link_To_Wp_File_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pda-link-to-wp-file-deactivator.php
 */
function deactivate_pda_wp_link_to_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pda-link-to-wp-file-deactivator.php';
	Pda_Link_To_Wp_File_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pda_wp_link_to_wp' );
register_deactivation_hook( __FILE__, 'deactivate_pda_wp_link_to_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pda-link-to-wp-file.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pda_wp_link_to_wp() {

	$plugin = new Pda_Link_To_Wp_File();
	$plugin->run();

}
run_pda_wp_link_to_wp();
/*
 * Add option to menu
add_action('init', 'add_option_to_menu');

function add_option_to_menu() 
{
    $labels = array(
        'name' => 'All Files',
        'singular_name' => 'Image Name',
        'all_items' => 'All Files',
        'add_new_item' => 'Add New Image',
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    
    'supports' => array('title','editor','author','comments', 'custom-fields', 'trackbacks'),
  );
  register_post_type('attachment',$args);
}

add_filter( 'nav_menu_link_attributes', 'filter_function_name', 10, 3 );

function filter_function_name( $atts, $item, $args ) {
    $img_id = $item->object_id;
    $url = get_url_by_id($img_id);
    if("Image Name" == $item->type_label) {
    	$atts['href'] = $url[0]->guid;
    }
    return $atts;
}

function get_url_by_id ($id) {
	global $wpdb;
	$queryString = "SELECT * FROM wp_posts WHERE ID = $id";
	$url = $wpdb->get_results( $queryString );
	return $url;
}
*/

/*
//Add option to widget
class MyNewWidget extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct( false, 'All Images' );
    }

    function widget( $args, $instance ) {
        // Widget output
    }

    function update( $new_instance, $old_instance ) {
        // Save widget options
    }

    function form( $instance ) {
        // Output admin widget options form
    }
}

function myplugin_register_widgets() {
    register_widget( 'MyNewWidget' );
}

add_action( 'widgets_init', 'myplugin_register_widgets' );
*/