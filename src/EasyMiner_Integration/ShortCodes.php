<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

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
        $title = __('To Source', 'EasyMiner-WordPress-Plugin');
	    $output = '<a title="'.$title.'" class="shortcode-link" href="'.$permalink.'#blockId='.$block_id.'" target="_blank">&#x21f0;</a>';
        return $output;
    }
}
