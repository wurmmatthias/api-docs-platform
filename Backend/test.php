<?php
$json = '{"time":1737717957990,"blocks":[{"id":"NSy_xyCY9J","type":"paragraph","data":{"text":"<code class="inline-code">Hier steht Code</code>"}}],"version":"2.30.7"}';

// Doppelte Anführungszeichen in Werten escapen
$json = preg_replace_callback('/"([^"]*?)":\s*"(.*?)(?<!\\\\)"/', function ($matches) {
    return '"' . $matches[1] . '": "' . addslashes($matches[2]) . '"';
}, $json);

// JSON dekodieren
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON Decode Error: ' . json_last_error_msg());
}

// Verarbeiten
print_r($data);
?>