<?php
include "connect.php";


$current_user = $_SESSION['user'];


$sql_postinfo = "SELECT * FROM user WHERE username ='" . $current_user . "'";
$result_postsinfo = mysqli_query($conn, $sql_postinfo);

 if (mysqli_num_rows($result_postsinfo) > 0) {
 // output data of each row
 while($row_post = mysqli_fetch_assoc($result_postsinfo)) {
    if ($row_post["lang"] == "de") {
        $global_language_setting = "de";
    }
    else if ($row_post["lang"] == "en") {
        $global_language_setting = "en";
    }
 }
 } 
 else {
    $global_language_setting = "de";
 }



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