<?php

namespace EasyMiner_Integration;

class ShortCodes
{
	public function __construct() {
        add_shortcode( 'easyminer-link', array($this, 'report_callback') );
	}

	public function report_callback($attr) {
        $post_id = $attr['post_id'];
        $block_id = $attr['block_id'];
        $block_id = preg_replace('/\s/', 'XXX', $block_id);
        $permalink = get_permalink($post_id);
	    $output = '<a class="shortcode-link" href="'.$permalink.'#blockId='.$block_id.'" target="_blank">&#x21f0;</a>';
        return $output;
    }
}
