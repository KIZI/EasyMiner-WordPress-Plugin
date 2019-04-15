<?php
defined( 'ABSPATH' ) or die;
use EasyMiner_Integration\Transformace;
$tr = new Transformace();
$post = get_post();

if (!$post->post_content) {
    wp_redirect(get_permalink($post->ID));
}

$html = $tr->getHTML($post);
echo $html;

