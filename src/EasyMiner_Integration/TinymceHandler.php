<?php

namespace EasyMiner_Integration;


class TinymceHandler extends AssetsHandler
{

    public function __construct()
    {
        parent::__construct();
            add_action('media_buttons', array($this, 'tlacitko_callback'), 15);
            add_action('wp_enqueue_media', array($this, 'zaradit_javascript'));
    }

    public function tlacitko_callback()
    {
        echo
        "<a  href='#TB_inline?&width=750&height=550&inlineId=ea-dialog'
             id='ea-tlacitko'
             class='button thickbox'>Vložit report
        </a>";
    }

    function zaradit_javascript()
    {
        wp_enqueue_script('media_button',
            plugins_url( '/assets/tinymce/ea-tinymce.js', $this->plugin_file),
            array('jquery'), '1.0', true);
    }
}