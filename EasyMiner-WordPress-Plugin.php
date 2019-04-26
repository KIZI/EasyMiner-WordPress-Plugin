<?php
/**
Plugin Name:  EasyMiner Integration
Plugin URI:   https://github.com/KIZI/EasyMiner-WordPress-Plugin
Description:  EasyMiner Integration Plugin for WordPress
Author:       Petr Novák
License:      Apache
License URI:  http://www.apache.org/licenses/LICENSE-2.0.html
 */
defined( 'ABSPATH' ) or die;

define('EASYMINER_PLUGIN_FILE', __FILE__);

require_once 'src/autoload.php';
require_once 'src/init.php';

load_plugin_textdomain( 'EasyMiner-WordPress-Plugin',
    false, basename( dirname( __FILE__ ) ) . '/languages' );
