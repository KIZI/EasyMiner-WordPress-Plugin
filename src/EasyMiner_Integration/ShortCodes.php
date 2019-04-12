<?php

namespace EasyMiner_Integration;

class ShortCodes
{
	public function __construct() {
        add_shortcode( 'easyminer-link', array($this, 'report_callback') );
	}

	public function report_callback($attr) {
	    //wp_die($attr['post_id']);
        $post_id = $attr['post_id'];
        //$block_id = $attr['block_id'];
        $permalink = get_permalink($post_id);
	    $output = '<a href="'.$permalink.'#blockId=0" target="_blank">Odkaz</a>';
	    //$output.= $permalink;

        return $output;
    }
}
