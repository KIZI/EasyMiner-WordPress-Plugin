<?php

namespace EasyMiner_Integration;

class GutenbergHandler extends AssetsHandler
{
    function __construct() {
        parent::__construct();
        add_action('plugins_loaded', array($this, 'init'));
    }

    public function init() {
        add_action('init', array($this, 'register_assets'));
        add_action('enqueue_block_editor_assets',
            array($this, 'my_custom_format_enqueue_assets_editor'));
        add_action( 'admin_enqueue_scripts', array( &$this, 'thickbox' ) );
    }

    public function register_assets() {

        wp_register_script('easyminer-integration-gutenberg-js',
            plugins_url('assets/gutenberg/ea-gutenberg.js',
                $this->plugin_file),
            array('wp-blocks','wp-element','jquery'));
    }

    function my_custom_format_enqueue_assets_editor() {
        wp_enqueue_script('easyminer-integration-gutenberg-js');
        register_block_type( 'easyminerintegration/easyminerblock');
    }

    public function thickbox() {
        add_thickbox();
    }
}
