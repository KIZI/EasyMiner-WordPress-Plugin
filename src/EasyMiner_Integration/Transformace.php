<?php

namespace EasyMiner_Integration;

use DOMDocument;
use DOMXPath;
use DOMElement;
use XSLTProcessor;

class Transformace extends AssetsHandler
{
    public $xpath;
    public $DOMXpath;
    public $DOMDocument;
    public $selection;

    public function __construct() {
        parent::__construct();
        add_action('wp_ajax_easyminer_get_html_selection', array($this, 'getSelectedHTML'));
        $this->xpath = '(.//*[@data-easyminer-block-title])[1]/following-sibling::*[@data-easyminer-block-title]';
        $this->xpath.= '| (.//*[@data-easyminer-block-title])[1]';
    }

    public function getHTML($post) {
        $html = $post->html;
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
            $html = @$proc->transformToXml($xmlDoc);
            // https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#character-escaping
            update_post_meta($post->ID, 'html', wp_slash($html));
            return $html;
        }
    }

    public function getTreeselectArray($id) {
        $post = get_post($id);
        //$html = $this->getHTML($post);
        $html = file_get_contents(plugin_dir_path(__FILE__).'/ukazka.html');
        $this->DOMDocument = new DOMDocument();
        $this->DOMDocument->loadHTML($html, LIBXML_NOERROR);
        $this->DOMXpath = new DOMXPath($this->DOMDocument);
        $array = $this->parseElement($this->DOMDocument->documentElement);
        return $array;
    }

    public function parseElement(DOMElement $element) {
        $array = [];
        $children = $this->getChildren($element);
        foreach ($children as $child) {
            $childArray = [];
            $childArray['title'] = $this->getAttribute($child, 'data-easyminer-block-title');
            $childArray['id'] = $this->getAttribute($child, 'data-easyminer-block-id');
            $childArray['children'] = $this->parseElement($child);
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
        $this->DOMDocument = new DOMDocument();
        $this->DOMDocument->loadHTML($html, LIBXML_NOERROR);
        $rs = '[easyminer-link]';
        $rs .= $this->filterRootElement();
        echo '<div class="easyminer-block">'.$rs.'</div>';
        wp_die();
    }

    public function filterRootElement() {
        $rs = '';
        $this->DOMXpath = new DOMXPath($this->DOMDocument);
        $underBlocks = $this->getChildren();
        foreach ($underBlocks as $underBlock) {
            $id = $this->getAttribute($underBlock, 'data-easyminer-block-id');
            if (in_array($id, $this->selection, false)) {
                $filtered = $this->filterElement($underBlock);
                $rs .= $filtered;
            }
        }
        $rs = preg_replace("/\r|\n/", "", $rs);
        $rs = preg_replace("/>\s+<\//", "></", trim($rs));
        return $rs;
    }

    public function filterElement(DOMElement $element) {
        $children = $element->childNodes;
        $content = '';
        foreach($children as $child) {
            $content .= $this->DOMDocument->saveHTML($child);
        }
        $underBlocks = $this->getChildren($element);
        foreach($underBlocks as $underBlock) {
            $id = $this->getAttribute($underBlock, 'data-easyminer-block-id');
            $underBlockContent = $this->DOMDocument->saveHTML($underBlock);
            if (!in_array($id, $this->selection, false)) {
                $content = str_replace($underBlockContent, "", $content);
            } else {
                $content = str_replace($underBlockContent, $this->filterElement($underBlock), $content);
            }
        }
        return $content;
    }

    private function getChildren(DOMElement $element = null) {
        return $this->DOMXpath->query($this->xpath, $element);
    }

    private function getAttribute($element, $name) {
        return $element->attributes->getNamedItem($name)->value;
    }
}