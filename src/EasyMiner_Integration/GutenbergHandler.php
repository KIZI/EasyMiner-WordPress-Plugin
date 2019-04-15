<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

class GutenbergHandler
{
    function __construct() {
	    add_action('init', array($this, 'on_init'));
	    add_action('enqueue_block_editor_assets',
		    array($this, 'enqueue'));
    }

    public function on_init() {
		global $easyminer_integration_plugin_file;
        wp_register_script('easyminer-integration-gutenberg-js',
            plugins_url('assets/gutenberg/ea-gutenberg.js',
	            $easyminer_integration_plugin_file),
            array('wp-blocks','wp-element','jquery'));
    }

    function enqueue() {
	    register_block_type( 'easyminerintegration/easyminerblock');
    	wp_enqueue_script('easyminer-integration-gutenberg-js');
	    add_thickbox();
    }
}