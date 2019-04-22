<?php
defined( 'ABSPATH' ) or die;
use EasyMiner_Integration\Transformations;
$tr = new Transformations();
$post = get_post();
$html = $tr->getHTML($post);
echo $html;