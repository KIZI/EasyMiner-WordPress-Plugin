<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

class  EasyminerReportType
{
    public function __construct() {
        add_action('init', array($this, 'on_init'));
    }

    public function report_template($single) {
        global $post;
        if ($post->post_type == 'easyminer-report') {
            $cesta_k_sablone =
	        plugin_dir_path(EASYMINER_PLUGIN_FILE).
	        '/themes/single-easyminer-report.php';
            if (file_exists($cesta_k_sablone)) {
                return $cesta_k_sablone;
            }
        }
        return $single;
    }

    public function on_init() {

        $found = locate_template('single-easyminer-report.php');
        if (!$found) {
            add_filter('single_template', array($this, 'report_template'));
        }

        $args = array(
            'name'                => __('Task Reports', 'EasyMiner-WordPress-Plugin'),
            'singular_name'       => __('Task Report', 'EasyMiner-WordPress-Plugin'),
            'labels' => [
                'name'=> __('Task Reports', 'EasyMiner-WordPress-Plugin'),
                'singular_name'=> __('Task Report', 'EasyMiner-WordPress-Plugin'),
                'menu_name'=> __('Task Reports', 'EasyMiner-WordPress-Plugin'),
                'all_items'=> __('All Task Reports', 'EasyMiner-WordPress-Plugin'),
                'view_item'=> __('View', 'EasyMiner-WordPress-Plugin'),
                'search_items'=> __('Search', 'EasyMiner-WordPress-Plugin'),
                'not_found'=> __('Not found', 'EasyMiner-WordPress-Plugin'),
                'not_found_in_trash'=> __('Not found in Trash', 'EasyMiner-WordPress-Plugin'),
            ],
            'supports'            => array('title', 'author'),
            'taxonomies'          => [],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-analytics',
            'can_export'          => true,
            'has_archive'         => true,
            'capabilities'        => array(
                'create_posts' => 'do_not_allow'
            ),
            'map_meta_cap' => true,
        );
        register_post_type('easyminer-report', $args);
    }
}