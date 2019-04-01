<?php
namespace EasyMiner_Integration;

// tyhle třídy se musí naincludovat https://wordpress.stackexchange.com/questions/211647/fatal-error-after-4-4-upgrade-class-wp-list-table
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-screen.php' );
    require_once( ABSPATH . 'wp-admin/includes/screen.php' );
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
    require_once( ABSPATH . 'wp-admin/includes/template.php' );
}

class AnalyticalReportsTable extends \WP_List_Table {

    public function prepare_items() {
        $this->items = get_posts( array(
            'post_type' => 'easyminer-report'
        ));

        $columns = $this->get_columns();
        $this->_column_headers = array($columns);
    }

    public function get_columns() {
        $columns = array(
            'title' => __('Title', 'EasyMiner-WordPress-Plugin'),
            'miner_id' => __('Miner ID', 'EasyMiner-WordPress-Plugin'),
            'task_id' => __('Task ID', 'EasyMiner-WordPress-Plugin')
        );

        return $columns;
    }

    public function column_default($item, $column_name) {
        // jenom abych otestovat, že se zobrazují identifikátory
        //update_post_meta( $item->ID, 'miner_id', 1234);
        //update_post_meta( $item->ID, 'task_id', 4567);        
        switch ($column_name) {
            case 'title':
            return $item->post_title;
            case 'miner_id':
            return get_post_meta( $item->ID, 'miner_id', true );
            case 'task_id':
            return get_post_meta( $item->ID, 'task_id', true );
            default:
            return 'no value';
        }
    }
}