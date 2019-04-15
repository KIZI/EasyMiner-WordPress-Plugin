<?php

defined( 'ABSPATH' ) or die;

use EasyMiner_Integration as EI;

$rest = new EI\REST();
$shortcodes = new EI\ShortCodes();
$assets = new EI\Assets();
$reportType = new EI\EasyminerReportType();
$tinymce = new EI\TinyMCEHandler();
$gutenberg = new EI\GutenbergHandler();
$popUpContent = new EI\PopUpContent();