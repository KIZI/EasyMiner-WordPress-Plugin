<?php

function getSelectedHTML() {
    $selection = $_GET['selection'];
    $this->selection = $selection;
    $id = $_GET['id'];
    //$html = $this->getHTML(get_post($id));
    $html = file_get_contents(plugin_dir_path(__FILE__).'/ukazka.html');
    $doc = new DOMDocument();
    $doc->loadHTML($html, LIBXML_NOERROR);
    //$xml = simplexml_load_string($html);
    $xml = simplexml_import_dom($doc);
    //$xml->xmlEncoding = 'UTF-8';
    $rs = '[easyminer-link]';
    $rs .= $this->filterRootNode($xml);
    echo '<div class="easyminer-block">'.$rs.'</div>';
    wp_die();
}

function FilterRootNode(SimpleXMLElement $xml) {
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
    $rs = preg_replace("/>\s+<\//", "></", trim($rs));
    return $rs;
}

function filterNode(SimpleXMLElement $xml) {
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