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
        add_action('enqueue_block_editor_assets', array($this, 'register_assets'));
    }

    public function register_assets()
    {
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }

        wp_enqueue_script('easyminer_integration-js',
            plugins_url( '/assets/block/block.js', $this->plugin_file),
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor',
                'underscore', 'wp-edit-post', 'wp-plugins', 'wp-data', 'wp-compose'),
            filemtime( plugin_dir_path( $this->plugin_file ) . '/assets/entry.js'));

    }

}
