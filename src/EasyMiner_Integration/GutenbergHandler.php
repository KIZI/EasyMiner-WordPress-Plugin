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
        wp_register_script('easyminer-integration-gutenberg-js',
            plugins_url('assets/gutenberg/ea-gutenberg.js',
	            EASYMINER_PLUGIN_FILE),
            array('wp-blocks','wp-element','jquery'));
        wp_localize_script('easyminer-integration-gutenberg-js',
            'eaGutenbergLocalize',
            array(
                'blockName' =>__('EasyMiner Task Report Block', 'EasyMiner-WordPress-Plugin')
            ));
    }

    function enqueue() {
    	wp_enqueue_script('easyminer-integration-gutenberg-js');
	    add_thickbox();
    }
}