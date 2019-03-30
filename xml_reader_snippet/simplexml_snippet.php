<?php

$string = '<notes>
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
</notes>';

$xml = new SimpleXMLElement($string);
$vysledek = $xml->xpath('note/from');

foreach ($vysledek as $polozka) {
    echo $polozka->asXML();
}