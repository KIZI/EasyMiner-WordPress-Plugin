<?php

namespace EasyMiner_Integration;

use WP_List_Table;

class AnalyticalReportsTable extends WP_List_Table {

    public $data;

    public function prepare_items() {
        $data = get_posts( array(
            'post_type' => 'easyminer-report'
        ));

        $columns = $this->get_columns();
        $this->_column_headers = array($columns);
    }

    public function get_columns() {
        $columns = array(

        );

        return $columns;
    }

    public function column_default($item, $column_name) {
        
        switch ($column_name) {

        }
    }
}