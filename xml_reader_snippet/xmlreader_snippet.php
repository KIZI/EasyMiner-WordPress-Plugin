<?php

$xml = new XMLReader();
$xml->open('soubor.xml');

$notes = array();

while($xml->read()) {

    if ($xml->nodeType == XMLReader::ELEMENT and $xml->localName == 'note') {
        $note = array();
        $note['id'] = $xml->getAttribute('id');
    }

    if ($xml->nodeType == XMLReader::END_ELEMENT and $xml->localName == 'note') {
        $notes[] = $note;
    }

    if ($xml->nodeType == XMLReader::ELEMENT and $xml->localName == 'to') {
        $xml->read();
        $note['to'] = $xml->value;
    }

    if ($xml->nodeType == XMLReader::ELEMENT and $xml->localName == 'from') {
        $xml->read();
        $note['from'] = $xml->value;
    }

    if ($xml->nodeType == XMLReader::ELEMENT and $xml->localName == 'heading') {
        $xml->read();
        $note['heading'] = $xml->value;
    }

    if ($xml->nodeType == XMLReader::ELEMENT and $xml->localName == 'body') {
        $xml->read();
        $note['body'] = $xml->value;
    }
}