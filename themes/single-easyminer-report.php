<?php



$xslDoc = new DOMDocument();
$xslDoc->load(__DIR__."/4FTPMML2HTML.xsl");

$xmlDoc = new DOMDocument();
$xmlDoc->load(__DIR__."/LM1.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXml($xmlDoc);

//get_footer();