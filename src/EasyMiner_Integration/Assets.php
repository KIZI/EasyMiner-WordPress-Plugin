<?php

namespace EasyMiner_Integration;


class Assets extends AssetsHandler
{
    public function __construct()
    {
        parent::__construct();
        add_action('init', array($this, 'obecne_scripty'));
    }

    public function obecne_scripty()
    {
        wp_enqueue_style(
            'easyminer-integration-css',
            plugins_url( '/assets/styles.css', $this->plugin_file )
        );

        wp_enqueue_script(
            'easyminer-integration-js',
            plugins_url('/assets/script.js', $this->plugin_file)
        );
    }
}