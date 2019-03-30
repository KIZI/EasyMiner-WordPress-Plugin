<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$posts = get_posts(array(
    'post_type' => 'easyminer-report'
));

foreach($posts as $post) {
    wp_delete_post($post->ID, true);
}