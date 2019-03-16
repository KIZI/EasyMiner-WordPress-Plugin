<?php

use EasyMiner_Integration\Transformace;

//get_header();
$tr = new Transformace();
$post = get_post();
$content = $post->post_content;
if (!$content) {
    wp_redirect(get_permalink($post->ID));
}
echo $tr->getHTML($content);
//get_footer();