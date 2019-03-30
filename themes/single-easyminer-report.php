<?php

use EasyMiner_Integration\Transformace;

//get_header();
echo '<h1>Ahoj</h1>';
$tr = new Transformace();
$post = get_post();

$content = $post->post_content;
if (!$content) {
    wp_redirect(get_permalink($post->ID));
}
echo $tr->getHTML($content);
//get_footer();