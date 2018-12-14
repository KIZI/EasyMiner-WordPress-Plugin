<?php

namespace EasyMiner_Integration;


class SeznamReportu
{
    public $reporty;

    public function __construct()
    {
        $this->reporty = array();
    }

    public function getReporty()
    {
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );

        $posts_array = get_posts($args);

        $this->reporty = $posts_array;

        return $this->reporty;
    }

    public function getPravidla($id)
    {
        $post = get_post($id);
        return $post->post_content;
    }
}