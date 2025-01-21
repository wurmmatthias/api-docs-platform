<?php
// possible options 'de' for german language support, 'en' for a site-wide english configuration
// This setting is only valid for the frontend of the app.
$global_language_setting = "de";


function loadtranslation($lang) {
    $filePath = __DIR__ . "/{$lang}.json";
    if (file_exists($filePath)) {
        return json_decode(file_get_contents($filePath), true);
    }
    return []; // Fallback to an empty array if file not found
}

if ($global_language_setting == "de") {
    $language = loadtranslation("de");

} else if ($global_language_setting == "en") {
    $language = loadtranslation("en");
}



function __($key, $language)
{
    return $language[$key] ?? $key;
}
?>