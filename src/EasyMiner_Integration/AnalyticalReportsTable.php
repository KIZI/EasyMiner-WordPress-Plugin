<?php
namespace EasyMiner_Integration;


class AnalyticalReportsTable extends \WP_List_Table {

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
        // jenom abych otestovat, že se zobrazují identifikátory
        //update_post_meta( $item->ID, 'miner_id', 1234);
        //update_post_meta( $item->ID, 'task_id', 4567);
        switch ($column_name) {
            case 'title':
            return $this->renderTitle($item);
            case 'date':
            return date_i18n(get_option('date_format'), get_the_time('U', $item->ID));
            default:
            return 'no value';
        }
    }

    public function renderTitle($item) {
        $rs = "";
        $rs.= "<a class='row-title ea-report-polozka' ";
        $rs.= "id='ea-report-polozka-$item->ID' >";
        $rs.= $item->post_title;
        $rs.= "</a>";
        return $rs;
    }

    //Overriden
    function no_items() {
        _e( 'No Analytical Reports Found', 'EasyMiner-WordPress-Plugin' );
    }
}