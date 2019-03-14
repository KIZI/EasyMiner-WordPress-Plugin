<?php
//header("Content-type: application/xhtml+xml");
//get_header();

$xslDoc = new DOMDocument();
$xslDoc->load(__DIR__."/4FTPMML2HTML.xsl", LIBXML_NOCDATA);

$xmlDoc = new DOMDocument();
$xmlDoc->load(__DIR__."/LM1.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXml($xmlDoc);
//get_footer();