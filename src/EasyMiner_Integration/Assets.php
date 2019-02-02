<?php

namespace EasyMiner_Integration;


class Assets extends AssetsHandler
{
    public function __construct()
    {
        parent::__construct();
        add_action('init', array($this, 'obecne_styly'));
    }

    public function obecne_styly()
    {
        wp_enqueue_style(
            'easyminer_integration-css',
            plugins_url( '/assets/styles.css', $this->plugin_file )
        );
    }
}