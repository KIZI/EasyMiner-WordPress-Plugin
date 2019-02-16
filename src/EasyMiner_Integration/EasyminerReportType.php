<?php

namespace EasyMiner_Integration;

class EasyminerReportType
{
    private $typeName;
    private $customColumnName;

    public function __construct()
    {
        $this->typeName = 'easyminer-report';
        $this->customColumnName = 'nahled';
        add_action('init', array($this, 'zaregistruj_typ'));
        add_filter('post_row_actions', array($this, 'report_row_actions'), 10, 2);
        add_filter("bulk_actions-edit-$this->typeName", array($this, 'report_bulk_actions'));
        add_filter("manage_edit-$this->typeName"."_columns",
            array($this, 'manage_columns'));
        add_action("manage_$this->typeName"."_posts_custom_column",
            array($this, 'custom_column'), 10, 2);
    }

    public function manage_columns($columns) {
        unset($columns['title']);
        $columns[$this->customColumnName] = 'Title';
        $columns = array(
            'cb' => $columns['cb'],
            'nahled' => $columns[$this->customColumnName],
            'date' => $columns['date']
        );
        return $columns;
    }

    public function custom_column($column_name, $post_id) {
        if ($column_name != $this->customColumnName)
            return;
        $post = get_post($post_id);
        ?>
        <strong>
            <a class="row-title"
               href="<?php echo get_permalink($post) ?>"
               aria-label="<?php echo get_the_title($post) ?>">
                <?php echo get_the_title($post) ?>
            </a>
        </strong>
        <div class="row-actions">
            <span class="trash">
                <a class="submitdelete"
                   href="<?php echo get_delete_post_link($post)?>">
                    <?php echo _('Trash');?>
                </a>
            </span>
        </div>
        <?php
    }

    public function report_bulk_actions($actions) {
        unset($actions['edit']);
        return $actions;
    }

    public function zaregistruj_typ()
    {
        $args = array(
            'name'                => 'Analytické zprávy',
            'singular_name'       => 'Analytická zpráva',
            'labels' => array(
                'name'=> 'Analytické zprávy',
                'singular_name'=> 'Analytická zpráva',
                'menu_name'=> 'Analytické zprávy',
                'all_items'=> 'Všechny analytické zprávy',
                'view_item'=> 'Zobrazit',
                'search_items'=> 'Hledat',
                'not_found'=>__('Not found'),
                'not_found_in_trash'=>__('Not found in Trash'),
            ),
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
            'capabilities' => array(
                'create_posts' => 'do_not_allow',
            ),
            'map_meta_cap' => true,
            'rewrite'             => array(
                'slug'              => 'easyminer_reports'
            )
        );
        register_post_type($this->typeName, $args);
//        wp_insert_post(array(
//            'post_title' => 'Název',
//            'post_content' => 'Obsah',
//            'post_status' => 'publish',
//            'post_type' => $this->typeName,
//        ), false);
    }
}