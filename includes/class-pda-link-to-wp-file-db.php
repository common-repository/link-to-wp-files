<?php
	class Pda_Link_To_Wp_File_Databases{
		function get_url_by_id ($id) {
			global $wpdb;
			$queryString = "SELECT * FROM wp_posts WHERE ID = $id";
			$url = $wpdb->get_results( $queryString );
			return $url;
		}	
	}
?>