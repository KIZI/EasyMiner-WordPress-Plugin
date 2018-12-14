<?php


namespace EasyMiner_Integration;

class PopUpContent
{
    public $seznamReportu;

    public function __construct()
    {
        $this->seznamReportu = new SeznamReportu();
        $this->ajax_akce();
        add_action('admin_footer', array($this, 'render_obsah'));
    }

    public function ajax_akce()
    {
        add_action('wp_ajax_zobraz_reporty', array($this, 'zobraz_reporty'));
        add_action('wp_ajax_zobraz_pravidla', array($this, 'zobraz_pravidla'));
    }

    public function zobraz_reporty()
    {
        foreach($this->seznamReportu->getReporty() as $report)
        {
            $nazev = $report->post_title;
            $id = $report->ID;
            ?>
            <p class='ea-report-polozka' id='ea-report-polozka-<?php echo $id ?>'>
                <a class='row-title'>
                    <?php echo $nazev?>
                </a>
            </p>
            <?php
        }
        wp_die(); //takto musí končit každá ajax akce
    }

    public function zobraz_pravidla()
    {
        echo $this->seznamReportu->getPravidla($_GET['id']);
        wp_die(); //takto musí končit každá ajax akce
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
            <button class="button-primary" id="ea-button-vlozit">Vložit</button>
            <div id="ea-tb-container"></div>
        </div>
        <?php
    }
}
