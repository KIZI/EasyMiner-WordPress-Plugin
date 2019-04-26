<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

class Assets {
	public $plugin_file;
    public function __construct() {
        add_action('init', array($this, 'on_init'));
        add_action('admin_init', array($this, 'on_admin_init'));
        add_action('admin_enqueue_scripts', array($this, 'on_admin_enqueue_scripts'));
    }

    public function on_init() {

        wp_register_script(
            'easyminer-integration-scroll-js',
            plugins_url('/assets/scrollService.js', EASYMINER_PLUGIN_FILE), array('jquery'),
            '1.0', true
        );
    }

	public function on_admin_init() {
		wp_register_style(
			'easyminer-integration-css',
			plugins_url( '/assets/styles.css', EASYMINER_PLUGIN_FILE )
		);

		wp_register_script(
			'easyminer-integration-js',
			plugins_url('/assets/script.js', EASYMINER_PLUGIN_FILE), array('jquery'),
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

	public function on_admin_enqueue_scripts() {
		wp_enqueue_script('easyminer-integration-js');
		wp_enqueue_style('easyminer-integration-css');
	}
}