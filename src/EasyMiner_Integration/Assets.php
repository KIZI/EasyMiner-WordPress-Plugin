<?php

namespace EasyMiner_Integration;


class Assets extends AssetsHandler
{
    public function __construct() {
        parent::__construct();
        add_action('init', array($this, 'general_assets'));
    }

    public function general_assets() {
        wp_enqueue_style(
            'easyminer-integration-css',
            plugins_url( '/assets/styles.css', $this->plugin_file )
        );

        wp_enqueue_script(
            'easyminer-integration-js',
            plugins_url('/assets/script.js', $this->plugin_file), array('jquery'),
            '1.0', true
        );
        wp_localize_script(
            'easyminer-integration-js',
            'EasyMinerLocalizeJS',
            array(
                'popUpTitle' => __('Report Selection', 'EasyMiner-WordPress-Plugin'),
            )
        );
    }
}