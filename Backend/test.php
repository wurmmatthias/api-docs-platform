<?php
$value = '{"time":1737967267672,"blocks":[{"id":"xcIq13c1dC","type":"paragraph","data":{"text":"<code class="inline-code">test</code>"}}],"version":"2.30.7"}';

$escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
$replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
$result = str_replace($escapers, $replacements, $value);

echo '<pre>';
echo($result);
echo '<pre>';
echo "<script>console.log('Debug Objects: " . $result . "' );</script>";
?>
