<?php

namespace EasyMiner_Integration;

class PopUpContent
{
    public $seznamReportu;

    public function __construct()
    {
        $this->seznamReportu = new SeznamReportu();
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
        $transformace = new Transformace();
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
        }
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
            <button class="button-primary"
                    id="ea-button-vlozit"
                    >Vložit</button>
            <div id="ea-tb-container"></div>
        </div>
        <?php
    }
}
