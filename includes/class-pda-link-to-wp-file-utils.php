<?php
/**
 * Created by PhpStorm.
 * User: gaupoit
 * Date: 1/5/18
 * Time: 15:30
 */

class Pda_Link_To_Wp_File_Utils {

    static function is_gold_pda_activated() {
        //We need plugin.php!
        require_once ( ABSPATH . 'wp-admin/includes/plugin.php' );

        $plugins = get_plugins();
        $has_pda = false;
        foreach ( $plugins as $plugin_path => $plugin ) {
            if ( $plugin['Name'] === 'Prevent Direct Access Gold' ) {
                $version =  (int)str_replace(".", "", $plugin['Version']);
                if ( $version >= 254 ) {
                    $has_pda = true;
                    break;
                }
            }
        }
        return $has_pda;
    }
}