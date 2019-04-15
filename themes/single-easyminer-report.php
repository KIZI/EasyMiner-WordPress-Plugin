<?php
defined( 'ABSPATH' ) or die;
use EasyMiner_Integration\Transformations;
$tr = new Transformations();
$post = get_post();

if (!$post->post_content) {
    wp_redirect(get_permalink($post->ID));
}

$html = $tr->getHTML($post);
echo $html;

