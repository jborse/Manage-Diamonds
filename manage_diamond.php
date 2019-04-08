<?php
/**
 * Plugin Name: Manage Diamonds
 * Description: Manage Diamond Plugin for import CSV file and show large data using datatable Server side Scripting ajax.
 * Version: 1.0
 * Author: Jayesh Borse
 */

function create_table() {
  	
	global $wpdb;
	$table_name = $wpdb->prefix.'diamond_stock';
	 
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $table_name (
			  `ds_id` int(11) NOT NULL AUTO_INCREMENT,
			  `reportNo` int(11) NOT NULL,
			  `reference` varchar(11) NOT NULL,
			  `shape` varchar(11) NOT NULL,
			  `lab` varchar(11) NOT NULL,
			  `weight` double NOT NULL,
			  `color` varchar(3) NOT NULL,
			  `clarity` varchar(11) NOT NULL,
			  `cut` varchar(2) NOT NULL,
			  `polish` varchar(2) NOT NULL,
			  `symmetry` varchar(2) NOT NULL,
			  `fluorescence` varchar(7) NOT NULL,
			  `measurement` varchar(30) NOT NULL,
			  `depth` double NOT NULL,
			  `tables` int(3) NOT NULL,
			  `girdle` double NOT NULL,
			  `priceCarat` double NOT NULL,
			  `price` double NOT NULL,
			  `available` varchar(5) NOT NULL,
			  `certificateLink` varchar(126) NOT NULL,
			  `videoLink` varchar(126) NOT NULL,
			  PRIMARY KEY id (ds_id)		
		) $charset_collate;";
		 
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}
register_activation_hook( __FILE__, 'create_table' );

add_action("admin_menu", "manage_diamond_menu");

function manage_diamond_menu() {
    add_menu_page("Manage Diamond Page", "Manage Diamonds", 0, "manage_diamond", "manage_diamond_init");
    add_submenu_page("manage_diamond", "Import Diamonds", "Import Diamonds", 0, "import-diamond", "import_diamond_init");
}
 
function manage_diamond_init(){
	
	$file = ABSPATH."wp-content/plugins/manage_diamond/all_record.php";
	require( $file ); // use include if you want.

}

function import_diamond_init(){
    $file = ABSPATH."wp-content/plugins/manage_diamond/import_csv.php";
	require( $file ); // use include if you want.    

}

add_action('wp_ajax_ajaxfile', 'getDiamondsAjax');

function getDiamondsAjax() {
    $file = ABSPATH."wp-content/plugins/manage_diamond/ajaxfile.php";
	require( $file ); // use include if you want. 
}

?>