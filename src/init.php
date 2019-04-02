<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use EasyMiner_Integration as EI;

$rest = new EI\REST();
$shortcodes = new EI\ShortCodes();
$assets = new EI\Assets();
$reportTyp = new EI\EasyminerReportType();
$tinymce = new EI\TinymceHandler();
$gutenberg = new EI\GutenbergHandler();
$popUpContent = new EI\PopUpContent();