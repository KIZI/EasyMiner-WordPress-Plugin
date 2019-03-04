<?php
/**
Plugin Name:  EasyMiner Integration
Plugin URI:   https://github.com/KIZI/EasyMiner-WordPress-Plugin
Description:  EasyMiner Integration Plugin for WordPress
Author:       Petr Novák
License:      Apache
Domain Path:  /languages
Text Domain:  EasyMiner-WordPress-Plugin
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

load_plugin_textdomain( 'EasyMiner-WordPress-Plugin',
    false, basename( dirname( __FILE__ ) ) . '/languages' );






