<?php

namespace EasyMiner_Integration;

class TinymceHandler extends AssetsHandler
{

    public function __construct() {
        parent::__construct();
            add_action('media_buttons', array($this, 'tlacitko_callback'), 15);
            add_action('admin_enqueue_scripts', array($this, 'zaradit_javascript'));
    }

    public function tlacitko_callback() {
        ?>
        <a  id='ea-tlacitko'
             class='button'>Vložit report
        </a>
        <?php
    }

    function zaradit_javascript() {
        $current_screen = get_current_screen();
        if( (function_exists( 'is_gutenberg_page' ) && is_gutenberg_page())
        || (method_exists( $current_screen, 'is_block_editor' ) &&
            $current_screen->is_block_editor())) return;

        wp_enqueue_script('media_button',
            plugins_url( '/assets/tinymce/ea-tinymce.js', $this->plugin_file),
            array('jquery'), '1.0', true);
        wp_localize_script('media_button', 'TINYMCE', array(

        ));
    }
}