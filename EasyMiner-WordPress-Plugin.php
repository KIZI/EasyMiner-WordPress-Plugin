<?php
/**
Plugin Name:  EasyMiner Integration
Plugin URI:   https://github.com/KIZI/EasyMiner-WordPress-Plugin
Description:  EasyMiner Integration Plugin for WordPress
Author:       Petr Novák
License:      Apache
Domain Path:  /languages
License URI:  http://www.apache.org/licenses/LICENSE-2.0.html
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $easyminer_integration_plugin_file;
$easyminer_integration_plugin_file = __FILE__;

require_once 'src/autoload.php';
require_once 'src/init.php';

$slug = dirname(plugin_basename(__FILE__));

//wp_die(get_locale());


function myplugin_load_textdomain() {
    load_plugin_textdomain( 'EasyMiner-WordPress-Plugin',
        false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'init', 'myplugin_load_textdomain' );

