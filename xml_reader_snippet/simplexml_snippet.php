<?php

$html = file_get_contents('test.html');
$doc = new DOMDocument();
$doc->loadHTML($html, LIBXML_NOERROR);
$xml = simplexml_import_dom($doc);
$rs = filterNode($xml);

var_dump($rs);

function filterNode(SimpleXMLElement $xml) {
    $content = $xml->children();
    $joj = "";
    foreach($content as $content1) {
        $joj .= $content1->asXML();
    }
    $children = $xml->xpath('(.//*[@data-easyminer-block-title])[1]/following-sibling::*[@data-easyminer-block-title] | (.//*[@data-easyminer-block-title])[1]');
    return $joj;
}