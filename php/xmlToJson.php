<?php
function xmlToJson($url = 'http://ftp.geoinfo.msl.mt.gov/Documents/Metadata/GIS_Inventory/35524afc-669b-4614-9f44-43506ae21a1d.xml')
{
    $fileContents = file_get_contents($url);
    $xml          = simplexml_load_string(
        $fileContents
    );
    $json         = json_encode($xml);
    echo "<pre>";
    print_r($json);
    echo "</pre>";
}
