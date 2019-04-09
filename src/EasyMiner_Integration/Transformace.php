<?php

namespace EasyMiner_Integration;

use DOMDocument;
use SimpleXMLElement;
use XSLTProcessor;

class Transformace extends AssetsHandler
{
    public $xpath;
    public $selection;

    public function __construct() {
        parent::__construct();
        add_action('wp_ajax_easyminer_get_html_selection', array($this, 'getSelectedHTML'));
        $this->xpath = '(.//*[@data-easyminer-block-title])[1]/following-sibling::*[@data-easyminer-block-title]';
        $this->xpath.= '| (.//*[@data-easyminer-block-title])[1]';
    }

    public function getHTML($post) {
        $html = get_post_meta($post->ID, 'html', true);
        if ($html) {
            return $html;
        } else {
            $xslDoc = new DOMDocument();
            $xslDoc->load(
                plugin_dir_path($this->plugin_file)."/assets/xsl/4FTPMML2HTML.xsl",
                LIBXML_NOCDATA);

            $xmlDoc = new DOMDocument();
            //$xmlDoc->load(plugin_dir_path($this->plugin_file)."/assets/xsl/LM1.xml");
            $xmlDoc->loadXML($post->post_content, LIBXML_NOCDATA);
            $proc = new XSLTProcessor();
            $proc->importStylesheet($xslDoc);
            $html = $proc->transformToXml($xmlDoc);
            update_post_meta($post->ID, 'html', $html);
            return $html;
        }
    }

    public function getTreeselectArray($id) {
        $post = get_post($id);
        $content = $post->post_content;
        //$html = $this->getHTML($post);
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
        $children = $xml->xpath($this->xpath);
        foreach ($children as $child) {
            $childArray = [];
            $childArray['title'] = (string) $child['data-easyminer-block-title'];
            $childArray['id'] = (string) $child['data-easyminer-block-id'];
            $childArray['children'] = $this->parseNode($child);
            $array[] = $childArray;
        }
        return $array;
    }

    public function getSelectedHTML() {
        $selection = $_GET['selection'];
        $this->selection = $selection;
        $id = $_GET['id'];
        //$html = $this->getHTML(get_post($id));
        $html = file_get_contents(plugin_dir_path(__FILE__).'/ukazka.html');
        $doc = new DOMDocument();
        $doc->loadHTML($html, LIBXML_NOERROR);
        $xml = simplexml_import_dom($doc);
        $xml->xmlEncoding = 'UTF-8';
        $rs = '[easyminer-link]';
        $rs .= $this->filterRootNode($xml);
        echo '<div class="easyminer-block">'.$rs.'</div>';
        wp_die();
    }

    public function FilterRootNode(SimpleXMLElement $xml) {
        $rs = '';
        $underBlocks = $xml->xpath($this->xpath);
        foreach ($underBlocks as $underBlock) {
            $id = (string) $underBlock['data-easyminer-block-id'];
            if (in_array($id, $this->selection, false)) {
                $filtered = $this->filterNode($underBlock);
                $rs .= $filtered;
            }
        }
        $rs = preg_replace("/\r|\n/", "", trim($rs));
        $rs = preg_replace("/>\s+</", "></", trim($rs));
        return $rs;
    }

    public function filterNode(SimpleXMLElement $xml) {
        $children = $xml->children();
        $content = '';
        foreach($children as $child) {
            $content .= $child->asXML();
        }
        $underBlocks = $xml->xpath($this->xpath);
        foreach($underBlocks as &$underBlock) {
            $id = (string) $underBlock['data-easyminer-block-id'];
            if (!in_array($id, $this->selection, false)) {
                $content = str_replace($underBlock->asXML(), "", $content);
            } else {
                $content = str_replace($underBlock->asXML(), $this->filterNode($underBlock), $content);
            }
        }
        return $content;
    }
}