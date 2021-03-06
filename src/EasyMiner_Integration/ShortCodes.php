<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

class ShortCodes
{
	public function __construct() {
        add_shortcode( 'easyminer-link', array($this, 'report_callback') );
	}

	public function report_callback($attr) {
        $output = '';
	    if (isset($attr['post_id']) && isset($attr['block_id'])) {
            $post_id = $attr['post_id'];
            $block_id = $attr['block_id'];
            $block_id = preg_replace('/\s/', 'XXX', $block_id);
            $permalink = get_permalink($post_id);
            $title = __('To Source', 'EasyMiner-WordPress-Plugin');
            $output .= '<a title="'.$title.'" class="shortcode-link" ';
		    $output .= 'href="'.$permalink.'#blockId='.$block_id.'" ';
		    $output .= 'target="_blank">&#x21f0;</a>';
        }
        return $output;
    }
}
