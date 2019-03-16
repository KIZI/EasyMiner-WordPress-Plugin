<?php

namespace EasyMiner_Integration;


use DOMDocument;
use XSLTProcessor;

class Transformace extends AssetsHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHTML($xmlString) {
        $xslDoc = new DOMDocument();
        $xslDoc->load(
            plugin_dir_path($this->plugin_file)."/assets/xsl/4FTPMML2HTML.xsl",
            LIBXML_NOCDATA);

        $xmlDoc = new DOMDocument();
        //$xmlDoc->load(plugin_dir_path($this->plugin_file)."/assets/xsl/LM1.xml");
        $xmlDoc->loadXML($xmlString);

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);
        return $proc->transformToXml($xmlDoc);
    }
}