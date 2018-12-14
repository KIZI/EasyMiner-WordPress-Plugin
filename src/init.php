<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use EasyMiner_Integration as EI;

$rewriter = new EI\Rewriter();
$shortcodes = new EI\ShortCodes();
$block = new EI\Block();
$gutenberg = new EI\GutenbergHandler();
$tinymce = new EI\TinymceHandler();
$assets = new EI\Assets();
//$reportTyp = new EI\EasyminerReportType();