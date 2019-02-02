<?php

namespace EasyMiner_Integration;


class Block
{
	public function __construct()
	{
		add_action('plugins_loaded', array($this, 'block_register'));
	}

	public function block_register()
	{
		if ( function_exists( 'register_block_type' ) ) {


            register_block_type( 'easyminer-integration/easyminer_report', array(
                'style' => 'easyminer_integration-css',
                'editor_script' => 'easyminer_integration-js',
                'render_callback' => array($this, 'block_callback'),
                'attributes' => array(
                    'atribut1' => array(
                        'type' => 'string'
                    ),
                )
            ) );
		}
	}

	public function block_callback($attr)
	{
		extract( $attr );
		if ( isset( $tweet ) ) {
			$theme = ( $theme === true ? 'click-to-tweet-alt' : 'click-to-tweet' );
			$shortcode_string = '[clicktotweet tweet="%s" tweetsent="%s" button="%s" theme="%s"]';
			return sprintf( $shortcode_string, $tweet, $tweetsent, $button, $theme );
		}
	}
}
