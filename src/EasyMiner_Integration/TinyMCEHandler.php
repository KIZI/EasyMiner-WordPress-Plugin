<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

class TinyMCEHandler
{

    public function __construct() {
        add_action('media_buttons', array($this, 'tlacitko_callback'), 15);
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    public function tlacitko_callback() {
        ?>
        <a  id='ea-button'
             class='button'><?php _e('Insert Report', 'EasyMiner-WordPress-Plugin');?>
        </a>
        <?php
    }

    function enqueue() {
        $current_screen = get_current_screen();
        if( (function_exists( 'is_gutenberg_page' ) && is_gutenberg_page())
        || (method_exists( $current_screen, 'is_block_editor' ) &&
            $current_screen->is_block_editor())) return;
	    global $easyminer_integration_plugin_file;
        wp_enqueue_script('easyminer-tinymce-js',
            plugins_url( '/assets/tinymce/ea-tinymce.js', $easyminer_integration_plugin_file),
            array('jquery'), '1.0', true);
    }
}