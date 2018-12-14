<?php
/**
Plugin Name:  EasyMiner Integration 2
Plugin URI:   https://github.com/PetrNovak96/easyminer-integration
Description:  EasyMiner Integration Plugin for WordPress
Version:      0.1
Author:       Petr Novák
License:      Apache
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
