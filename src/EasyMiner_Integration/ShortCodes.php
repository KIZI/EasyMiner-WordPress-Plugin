<?php

namespace EasyMiner_Integration;


class ShortCodes
{
	public function __construct()
	{
        add_shortcode( 'easyminer-report', array($this, 'report_callback') );
        add_shortcode( 'easyminer-rule', array($this, 'rule_callback') );
	}

	public function report_callback($attr, $content = null) {
        $output = '';
        $output.= $content;
        return $output;
    }

    public function rule_callback($attr) {
        $output = '';
        return $output;
    }
}
