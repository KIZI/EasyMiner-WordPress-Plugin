<?php

use EasyMiner_Integration\Transformace;

$tr = new Transformace();
$post = get_post();

$content = $post->post_content;
if (!$content) {
    wp_redirect(get_permalink($post->ID));
}
echo $tr->getHTML($content);

/*
__ ZKUSIL JSEM, ALE NEFUNGUJE __
$html = get_post_meta($post->ID, 'html', true);
if ($html) {
    echo $html;
    exit;
} else {
    $content = $post->post_content;
    if (!$content) {
        wp_redirect(get_permalink($post->ID));
    }
    $html = $tr->getHTML($content);
    update_post_meta($post->ID, 'html', $html);
    echo $html;
}