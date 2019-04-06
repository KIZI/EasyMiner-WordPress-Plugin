<?php

$html = file_get_contents('ukazka.html');
$doc = new DOMDocument();
$doc->loadHTML($html, LIBXML_NOERROR);
$xml = simplexml_import_dom($doc);
$array = parseNode($xml);

var_dump($array);
function parseNode(SimpleXMLElement $xml) {
    $array = [];
    $children = $xml->xpath('(.//*[@data-easyminer-block-title])[1]/following-sibling::*[@data-easyminer-block-title] | (.//*[@data-easyminer-block-title])[1]');
    foreach ($children as $child) {
        $childArray = [];
        $childArray['title'] = (string) $child['data-easyminer-block-title'];
        $childArray['id'] = (string) $child['data-easyminer-block-id'];
        $childArray['children'] = parseNode($child);
        $array[] = $childArray;
    }
    return $array;
}