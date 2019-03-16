<?php
//header("Content-type: application/xhtml+xml");
//get_header();

use EasyMiner_Integration\Transformace;

$tr = new Transformace();
$post = get_post();
$content = $post->post_content;

echo $tr->getHTML($content);
//get_footer();