<?php

namespace EasyMiner_Integration;

class GutenbergHandler extends AssetsHandler
{
    function __construct()
    {
        parent::__construct();
        add_action('plugins_loaded', array($this, 'init'));
    }

    public function init()
    {
        add_action('init', array($this, 'register_assets'));
        add_action('enqueue_block_editor_assets',
            array($this, 'my_custom_format_enqueue_assets_editor'));
        add_action( 'admin_enqueue_scripts', array( &$this, 'thickbox' ) );

    }

    public function register_assets()
    {

        wp_register_script('easyminer-integration-report-format-js',
                            plugins_url('assets/gutenberg/ea-report-format.js',
                                $this->plugin_file),
                            array('wp-rich-text'));

        wp_register_script('easyminer-integration-gutenberg-js',
            plugins_url('assets/gutenberg/script.js',
                $this->plugin_file),
            array('jquery'));
    }

    function my_custom_format_enqueue_assets_editor() {
        wp_enqueue_script('easyminer-integration-report-format-js');
        wp_enqueue_script('easyminer-integration-gutenberg-js');
    }

    public function thickbox() {
        add_thickbox();
    }
}
