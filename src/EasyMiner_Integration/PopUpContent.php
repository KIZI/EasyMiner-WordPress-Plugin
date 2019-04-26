<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

class PopUpContent {

    public $reportsTable;
    public $arrowRight;
    public $tr;

    public function __construct() {
        $this->arrowRight = plugins_url('/assets/img/arrow.svg', EASYMINER_PLUGIN_FILE );
        $this->tr = new Transformations();
        add_action('admin_init', array($this, 'createReportsTable'));
        add_action('wp_ajax_show_reports', array($this, 'show_reports'));
        add_action('wp_ajax_show_sections', array($this, 'show_sections'));
        add_action('admin_footer', array($this, 'render_content'));
    }

    // musí se volat až na admin_init https://core.trac.wordpress.org/ticket/29933
    public function createReportsTable() {
        $this->reportsTable = new TaskReportsTable();
    }

    public function show_reports() {
        ?>
        <style type="text/css">
        .wp-list-table .column-name { width: 70%; } 
        .wp-list-table .column-date { width: 30%; }
        </style>
        <?php
        $this->reportsTable->prepare_items();
        $this->reportsTable->display();
        wp_die();
    }

    public function show_sections() {
        $id = $_GET['id'];
        $treeselectArray = $this->tr->getTreeselectArray($id);
        echo '<ul class="easyminerReportUL" id="easyminer-report-'.$id.'">';
        foreach ($treeselectArray as $node) {
            echo $this->parseNode($node);
        }
        echo '</ul>';
        wp_die();
    }

    public function parseNode(array $node) {
        $rs = '<li><input id="'.$node['id'].'" type="checkbox"/>'.$node['title'];
        if (!empty($node['children'])) {
            $rs.= '<img class="ea-arrow" src="'.$this->arrowRight.'" alt="arrow.svg">';
            $rs.= '<ul class="closed">';
            foreach ($node['children'] as $child) {
                $rs.= $this->parseNode($child);
            }
            $rs.= '</ul>';
        }
        $rs.= '</li>';
        return $rs;
    }

    public function render_content() {
        if (function_exists('get_current_screen'))
        {
            $pt = get_current_screen()->post_type;
            if ( $pt != 'post' && $pt != 'page') return;
        }
        ?>
        <div id="ea-dialog">
            
            <div id="ea-tb-container"></div>
            <button class="closed button-secondary"
                    id="ea-button-back"
                    ><?php _e('Cancel', 'EasyMiner-WordPress-Plugin');?></button>
            <button class="button-primary"
                    id="ea-button-insert"
                    ><?php _e('Insert', 'EasyMiner-WordPress-Plugin');?></button>
        </div>
        <?php
    }
}