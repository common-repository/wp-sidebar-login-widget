<?php
/*
Plugin Name: wp-feedburner-form
Version: 1.0.1
Plugin URI: http://globaljobsforum.com/developer/wp-feed.htm
Description: Add feedburner email subscription form in your wordpress blog.
Author: Rohit
Author URI: http://www.globaljobsforum.com/
*/

    function fb_setup(){
    load_plugin_textdomain('fbf', null, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
    }
    add_action( 'init', 'fb_setup' );


		if ( !defined('WP_CONTENT_URL') )
		    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
		if ( !defined('WP_CONTENT_DIR') )
		    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );

		if (!defined('PLUGIN_URL'))
		    define('PLUGIN_URL', WP_CONTENT_URL . '/plugins');
		if (!defined('PLUGIN_PATH'))
		    define('PLUGIN_PATH', WP_CONTENT_DIR . '/plugins');

		define('FB_FILE_PATH', dirname(__FILE__));
		define('FB_DIR_NAME', basename(FB_FILE_PATH));
    add_action('admin_menu', 'fb_add_pages');
    function fb_add_pages() {
        add_plugins_page( 'FeedBurner Form', 'FeedBurner Form', 'manage_options', 'fbtools', 'fb_tools_page'); }
    function fb_tools_page() { include('refer/1.php');  }
    require PLUGIN_PATH .'/'.FB_DIR_NAME . '/refer/2.php';
    add_action('admin_head', 'fb_plugin_header');
    function fb_plugin_header() {
  	global $post_type, $page;
  	?>
   <style>
   span.fb-admin{background:#fff;font-family:courier;padding:2px; font-weight: bold }
   .fb-admin ul li{list-style:disc;list-style-position:inside;margin-left:20px;}

   .special {font-weight:bold;background:#fff;padding:4px ;border:1px dashed #ccc;}
   </style>
   <?php }
    function fbstyle($result) {
     wp_enqueue_style('fb_data_style', PLUGIN_URL ."/".FB_DIR_NAME."/refer/style.css");
    }
    add_filter('get_header','fbstyle');
?>