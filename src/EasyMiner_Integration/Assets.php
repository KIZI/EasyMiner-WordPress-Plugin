<?php

namespace EasyMiner_Integration;


class Assets extends AssetsHandler
{
    public function __construct()
    {
        parent::__construct();
        add_action('init', array($this, 'obecne_assets'));
    }

    public function obecne_assets()
    {
        wp_enqueue_style(
            'easyminer_integration-common-css',
            plugins_url( '/assets/common-styles.css', $this->plugin_file )
        );

        wp_enqueue_script(
            'easyminer_integration-common-js',
            plugins_url('/assets/common.js', $this->plugin_file),
            array('jquery'), '1.0', true
        );
    }
}