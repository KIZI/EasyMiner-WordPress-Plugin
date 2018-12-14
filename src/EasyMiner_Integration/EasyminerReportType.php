<?php

namespace EasyMiner_Integration;


class EasyminerReportType
{
    public function __construct()
    {
        add_action('init', array($this, 'zaregistruj_typ'));
    }

    public function zaregistruj_typ()
    {
        $args = array();
        register_post_type('easyminer_report', $args);
    }
}