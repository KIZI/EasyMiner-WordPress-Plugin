<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

class TaskReportsTable extends \WP_List_Table {

    public function prepare_items() {
        $this->items = get_posts( array(
            'post_type' => 'easyminer-report',
            'posts_per_page'=>-1, 
            'numberposts'=>-1
        ));
        $columns = $this->get_columns();
        $this->_column_headers = array($columns);
    }

    public function get_columns() {
        $columns = array(
            'title' => __('Title', 'EasyMiner-WordPress-Plugin'),
            'date' => __('Created', 'EasyMiner-WordPress-Plugin'),
        );
        return $columns;
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'title':
            return $this->renderTitle($item);
            case 'date':
            return date_i18n(get_option('date_format'), get_the_time('U', $item->ID));
            default:
            return __('No Value', 'EasyMiner-WordPress-Plugin');
        }
    }

    public function renderTitle($item) {
        $rs = "";
        $rs.= "<a class='row-title ea-report-item' ";
        $rs.= "id='ea-report-item-$item->ID' >";
        $rs.= $item->post_title;
        $rs.= "</a>";
        return $rs;
    }

    //Overriden
    function no_items() {
        _e( 'No Task Reports Found', 'EasyMiner-WordPress-Plugin' );
    }
}