<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.buildwps.com/prevent-direct-access-premium-plugin/?utm_source=user-website&utm_medium=pluginpage&utm_campaign=plugin-author-link
 * @since      1.0.0
 *
 * @package    Pda_Link_To_Wp_File
 * @subpackage Pda_Link_To_Wp_File/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pda_Link_To_Wp_File
 * @subpackage Pda_Link_To_Wp_File/includes
 * @author     buildwps <hello@ymese.com>
 */
class Pda_Link_To_Wp_File_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pda-wp-magic-link',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
