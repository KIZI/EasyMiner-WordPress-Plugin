<?php

namespace EasyMiner_Integration;

class PopUpContent extends AssetsHandler
{
    public $reportsTable;
    public $sipkaDoprava;

    public function __construct()
    {
        parent::__construct();
        $this->sipkaDoprava = plugins_url('/assets/img/arrow.svg', $this->plugin_file );
        add_action('admin_init', array($this, 'createReportsTable'));
        add_action('wp_ajax_zobraz_reporty', array($this, 'zobraz_reporty'));
        add_action('wp_ajax_zobraz_casti', array($this, 'zobraz_casti'));
        add_action('admin_footer', array($this, 'render_content'));
    }
    // musí se volat až na admin_init https://core.trac.wordpress.org/ticket/29933
    public function createReportsTable() {
        $this->reportsTable = new AnalyticalReportsTable();
    }

    public function zobraz_reporty()
    {
        ?>
        <style type="text/css">
        .wp-list-table .column-name { width: 70%; } 
        .wp-list-table .column-miner_id { width: 15%; }
        .wp-list-table .column-task_id { width: 15%; }
        </style>
        <?php
        $this->reportsTable->prepare_items();
        $this->reportsTable->display();
        wp_die();
    }

    public function zobraz_casti()
    {
        ?>
        <ul id="easyminerReportUL">
            <li><input type="checkbox"/>metadata</li>
            <li><input type="checkbox"/>obsah</li>
            <li><input type="checkbox"/>popis datového souboru</li>
            <li><input type="checkbox"/>vytvořené atributy</li>
            <li><input type="checkbox"/>zadání DM úlohy</li>
            <li><input type="checkbox"/>nalezená asociační pravidla
                <img class="sipka" src="<?php echo $this->sipkaDoprava;?>" alt="arrow.svg">
                <ul class="closed">
                    <li>
                        <input type="checkbox"/>Název
                        <img class="sipka" src="<?php echo $this->sipkaDoprava;?>" alt="arrow.svg">
                        <ul class="closed">
                            <li><input type="checkbox"/>Název</li>
                            <li><input type="checkbox"/>Míry zajímavosti</li>
                            <li><input type="checkbox"/>Čtyřpolní tabulka</li>
                        </ul>
                    </li>
                    <li>
                        <input type="checkbox"/>Název
                        <img class="sipka" src="<?php echo $this->sipkaDoprava;?>" alt="arrow.svg">
                        <ul class="closed">
                            <li><input type="checkbox"/>Název</li>
                            <li><input type="checkbox"/>Míry zajímavosti</li>
                            <li><input type="checkbox"/>Čtyřpolní tabulka</li>
                        </ul>
                    </li>
                    <li>
                        <input type="checkbox"/>Název
                        <img class="sipka" src="<?php echo $this->sipkaDoprava;?>" alt="arrow.svg">
                        <ul class="closed">
                            <li><input type="checkbox"/>Název</li>
                            <li><input type="checkbox"/>Míry zajímavosti</li>
                            <li><input type="checkbox"/>Čtyřpolní tabulka</li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <?php
        wp_die();
    }

    public function render_content()
    {
        if (function_exists('get_current_screen'))
        {
            $pt = get_current_screen()->post_type;
            if ( $pt != 'post' && $pt != 'page') return;
        }
        ?>
        <div id="ea-dialog">
            
            <div id="ea-tb-container"></div>
            <button class="button-secondary"
                    id="ea-button-zpet"
                    >Zpět</button>
            <button class="button-primary"
                    id="ea-button-vlozit"
                    >Vložit</button>
        </div>
        <?php
    }
}
