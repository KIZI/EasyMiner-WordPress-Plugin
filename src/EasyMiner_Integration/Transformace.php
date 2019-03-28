<?php

namespace EasyMiner_Integration;

use DOMDocument;
use SimpleXMLElement;
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

    public function getPravidla($id)
    {
        $post = get_post($id);
        $content = $post->post_content;
        $html = $this->getHTML($content);
        $xml = new SimpleXMLElement($html);
        $casti = array();
        $result = $xml->xpath('//*[@id="sect1"]');
        return $xml->xpath('//*[@id="sect4"]')[0];
        // pokud element s hledaným id není, tak se vrátí prázdné pole
    }

    public function getVybraneHTML(array $vyber) {

    }
}