<?php

namespace EasyMiner_Integration;


class ShortCodes
{
	public function __construct()
	{
        add_shortcode( 'clicktotweet', array($this, 'clicktotweet_callback') );
	}

	public function clicktotweet_callback( $attr ) {
		extract( $attr );
		if ( isset( $tweet ) ) {
			$output =
				'<div class="' . ( ! empty( $theme ) ? $theme : 'click-to-tweet' ) . '">
				<div class="ctt-text">' . $tweet . '</div>
				<p><a href="https://twitter.com/intent/tweet?text='.
				( ! empty( $tweetsent ) ? $tweetsent : $tweet ) .
				'" class="ctt-btn" target="_blank">' . $button . '</a></p>
			</div>';
			return $output;
		}
	}
}
