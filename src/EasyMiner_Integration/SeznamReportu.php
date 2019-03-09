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
            'post_type' => 'easyminer-report',
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
        $xml_string = get_post_meta($id, 'pmml', true);
        return $post->post_content;
    }
}