<?php

namespace EasyMiner_Integration;

class PopUpContent extends AssetsHandler
{
    public $seznamReportu;
    public $sipkaDoprava;

    public function __construct()
    {
        parent::__construct();
        $this->seznamReportu = new SeznamReportu();
        $this->sipkaDoprava = plugins_url('/assets/img/arrow.svg', $this->plugin_file );
        add_action('wp_ajax_zobraz_reporty', array($this, 'zobraz_reporty'));
        add_action('wp_ajax_zobraz_casti', array($this, 'zobraz_casti'));
        add_action('admin_footer', array($this, 'render_obsah'));
    }

    public function zobraz_reporty()
    {
        ?>
        <div id="checkboxes">
            <ul id="ea-reports-list">
        <?php
        foreach($this->seznamReportu->getReporty() as $report)
        {
            $nazev = $report->post_title;
            $id = $report->ID;
            ?>
            <li class='ea-report-polozka ea-nevybrana'
                id='ea-report-polozka-<?php echo $id ?>'
            >
                <a class='row-title' style="text-decoration: none"><?php echo $nazev?></a>
            </li>
            <?php
        }
        ?>
            </ul>
        </div>
        <?php
        wp_die();
    }

    public function zobraz_casti()
    {
        /* $transformace = new Transformace();
        if (isset($_GET['id'])) {
            $casti = $transformace->getPravidla($_GET['id']);
            foreach ($casti as $cast) {
                echo $cast->asXML();
            }
        }

        $pravidla = $this->seznamReportu->getPravidla($_GET['id']);
        foreach($pravidla as $pravidlo)
        {
            $nazev = $pravidlo['nazev'];
            $id = $pravidlo['id']
            ?>
            <li class='ea-pravidlo-polozka ea-nevybrana'
                id='ea-pravidlo-polozka-<?php echo $id ?>'
            >
                <input type="checkbox" class="ea-polozka-checkbox">
                <a class='row-title'><?php echo $nazev?></a>
            </li>
            <?php
        } */
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

    public function render_obsah()
    {
        if (function_exists('get_current_screen'))
        {
            $pt = get_current_screen()->post_type;
            if ( $pt != 'post' && $pt != 'page') return;
        }
        ?>
        <div id="ea-dialog">
            
            <div id="ea-tb-container"></div>
            <button class="button-primary"
                    id="ea-button-vlozit"
                    >Vložit</button>
        </div>
        <?php
    }
}
