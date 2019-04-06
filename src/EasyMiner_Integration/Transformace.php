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
        //TODO kontrola, jestli už existuje HTML musí být tady!!!
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

    public function getTreeselectArray($id) {
        $post = get_post($id);
        $content = $post->post_content;
        //$html = $this->getHTML($content);
        $html = file_get_contents(plugin_dir_path(__FILE__).'/ukazka.html');
        $doc = new DOMDocument();
        $doc->loadHTML($html, LIBXML_NOERROR);
        $xml = simplexml_import_dom($doc);
        $xml->xmlEndoding='UTF-8';
        $array = $this->parseNode($xml);
        return $array;
    }

    public function parseNode(SimpleXMLElement $xml) {
        $array = [];
        $children = $xml->xpath('(.//*[@data-easyminer-block-title])[1]/following-sibling::*[@data-easyminer-block-title] | (.//*[@data-easyminer-block-title])[1]');
        foreach ($children as $child) {
            $childArray = [];
            $childArray['title'] = (string) $child['data-easyminer-block-title'];
            $childArray['id'] = (string) $child['data-easyminer-block-id'];
            $childArray['children'] = $this->parseNode($child);
            $array[] = $childArray;
        }
        return $array;
    }

    public function getVybraneHTML(array $vyber) {

    }
}