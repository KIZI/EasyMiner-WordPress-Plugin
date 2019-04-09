<?php

namespace EasyMiner_Integration;

class  EasyminerReportType extends AssetsHandler
{
    public function __construct() {
        parent::__construct();
        add_action('init', array($this, 'on_init'));
    }

    public function report_template($single) {
        global $post;
        if ($post->post_type == 'easyminer-report') {
            $cesta_k_sablone = plugin_dir_path($this->plugin_file).'/themes/single-easyminer-report.php';
            if (file_exists($cesta_k_sablone)) {
                return $cesta_k_sablone;
            }
        }
        return $single;
    }

    public function on_init() {
        $nalez = locate_template('single-easyminer-report.php');
        if (!$nalez) {
            add_filter('single_template', array($this, 'report_template'));
        }

        $args = array(
            'name'                => __('Analytical Reports', 'EasyMiner-WordPress-Plugin'),
            'singular_name'       => __('Analytical Report', 'EasyMiner-WordPress-Plugin'),
            'labels' => [
                'name'=> __('Analytical Reports', 'EasyMiner-WordPress-Plugin'),
                'singular_name'=> __('Analytical Report', 'EasyMiner-WordPress-Plugin'),
                'menu_name'=> __('Analytical Reports', 'EasyMiner-WordPress-Plugin'),
                'all_items'=> __('All Analytical Reports', 'EasyMiner-WordPress-Plugin'),
                'view_item'=> __('View', 'EasyMiner-WordPress-Plugin'),
                'search_items'=> __('Search', 'EasyMiner-WordPress-Plugin'),
                'not_found'=> __('Not found', 'EasyMiner-WordPress-Plugin'),
                'not_found_in_trash'=> __('Not found in Trash', 'EasyMiner-WordPress-Plugin'),
            ],
            'description'         => '',
            'supports'            => array('title', 'author'),
            'taxonomies'          => [],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-analytics',
            'can_export'          => true,
            'has_archive'         => true,
            'capabilities'        => array(
                'create_posts' => 'do_not_allow'
            ),
            'map_meta_cap' => true,
            'rewrite'             => array(
                'slug'              => 'easyminer_reports'
            )
        );
        register_post_type('easyminer-report', $args);
    }
}