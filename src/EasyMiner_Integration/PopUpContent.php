<?php

namespace EasyMiner_Integration;

class PopUpContent
{
    public $seznamReportu;

    public function __construct()
    {
        $this->seznamReportu = new SeznamReportu();
        add_action('wp_ajax_zobraz_reporty', array($this, 'zobraz_reporty'));
        add_action('wp_ajax_zobraz_pravidla', array($this, 'zobraz_pravidla'));
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
                <input type="checkbox" class="ea-polozka-checkbox">
                <a class='row-title'><?php echo $nazev?></a>
            </li>
            <?php
        }
        ?>
            </ul>
        </div>
        <?php
        wp_die();
    }

    public function zobraz_pravidla()
    {
        echo $this->seznamReportu->getPravidla($_GET['id']);
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
