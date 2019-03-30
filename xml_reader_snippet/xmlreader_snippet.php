<?php

$xml = new XMLReader();
$xml->XML('<notes>
    <note id="1">
        <to>Tove</to>
        <from>Jani</from>
        <heading>Reminder</heading>
        <body>Don\'t forget me this weekend!</body>
    </note>
    <note id="2">
        <to>Petr</to>
        <from>Dan</from>
        <heading>DULEZITE</heading>
        <body>Dojed Dom!</body>
    </note>
</notes>', 'UTF-8');
//$xml->open('soubor.xml');
//TODO radši Simple XML

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