<?php

namespace EasyMiner_Integration;

class EasyminerReportType
{
    public function __construct()
    {
        add_action('init', array($this, 'zaregistruj_typ'));
    }

    public function zaregistruj_typ()
    {
        $args = array(
            'name'                => 'Analytické zprávy',
            'singular_name'       => 'Analytická zpráva',
            'labels' => [
                'name'=> 'Analytické zprávy',
                'singular_name'=> 'Analytická zpráva',
                'menu_name'=> __('Analytical Reports', 'easyminer-integration'),
                'all_items'=> 'Všechny analytické zprávy',
                'view_item'=> 'Zobrazit',
                'search_items'=> 'Hledat',
                'not_found'=>__('Not found', 'easyminer-integration'),
                'not_found_in_trash'=>__('Not found in Trash', 'easyminer-integration'),
            ],
            'description'         => '',
            'supports'            => array('title', 'custom-fields'),
            'taxonomies'          => [],
            'hierarchical'        => false,
            'public'              => false,
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