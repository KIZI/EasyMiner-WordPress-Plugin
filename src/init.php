<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use EasyMiner_Integration as EI;

$rewriter = new EI\Rewriter();
$shortcodes = new EI\ShortCodes();

$assets = new EI\Assets();
//$reportTyp = new EI\EasyminerReportType();
if(use_block_editor_for_post($post)){
    //Block editor is active for this post.
}
