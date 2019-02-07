<?php

namespace EasyMiner_Integration;


class AssetsHandler
{
    public $plugin_file;
    public $popUpContent;

    public function __construct()
    {
        global $easyminer_integration_plugin_file;
        $this->plugin_file = $easyminer_integration_plugin_file;
        $this->popUpContent = new PopUpContent();
    }

    /**
     * Check if the current page is the Gutenberg block editor.
     *
     * @author Vova Feldman (@svovaf)
     * @since  2.2.3
     *
     * @return bool
     */
    public function is_gutenberg_page() {
        if ( function_exists( 'is_gutenberg_page' ) &&
            is_gutenberg_page()
        ) {
            // The Gutenberg plugin is on.
            return true;
        }
        $current_screen = get_current_screen();
        if ( method_exists( $current_screen, 'is_block_editor' ) &&
            $current_screen->is_block_editor()
        ) {
            // Gutenberg page on 5+.
            return true;
        }
        return false;
    }
}