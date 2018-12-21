<?php

namespace EasyMiner_Integration;


class AssetsHandler
{
    public $plugin_file;

    public function __construct()
    {
        global $easyminer_integration_plugin_file;
        $this->plugin_file = $easyminer_integration_plugin_file;
        $neco = '0';
    }
}