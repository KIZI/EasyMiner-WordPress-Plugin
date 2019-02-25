<?php

namespace EasyMiner_Integration;

class Rewriter
{
    function __construct()
    {
        add_action('plugins_loaded', array($this, 'pridani_funkci'));
    }

    public function pridani_funkci()
    {
        add_action('init', array($this, 'rewrite'));
        add_action('template_redirect', array($this, 'tvorba_postu'));
    }

    public function rewrite()
    {
        add_rewrite_rule('^easyminer-integration/create-post/?$',
            'index.php',
            'top');
        flush_rewrite_rules();
    }

    public function tvorba_postu()
    {
        $post_title = isset($_POST['create_post_title'])? $_POST['create_post_title'] : null;
        $post_content = isset($_POST['create_post_content'])? $_POST['create_post_content'] : null;

        if ($post_title&&$post_content)
        {
            $id = wp_insert_post(array(
                'post_title' => $post_title,
                'post_content' => $post_content,
                'post_status' => 'publish',
                'post_type' => 'easyminer-report',
            ), false);
            wp_redirect(get_permalink($id));
        }
    }
}
