<?php
$json = '{"time":1737717123052,"blocks":[{"id":"z6R2C39WS4","type":"paragraph","data":{"text":"@@test@@test"}}],"version":"2.30.7"}';

function codeToText($string) {
    preg_match('/{"time":\d+,"blocks":\[\{"id":"[^"]+","type":"[^"]+","data":\{"text":"/', $string, $teilA);
    preg_match('/>[^<]+</', $string, $teilB);
    $teilBB = preg_replace('/[><]/', '', $teilB);
    preg_match('/"\}\}],"version":"[^"]+"}/', $string, $teilC);
    
    $str = $teilA[0] . $teilBB[0] . $teilC[0];
    return $str;
}



$data = json_decode($json, true);
$html = '';

foreach ($data['blocks'] as $block) {
    switch ($block['type']) {
        case 'header':
            $html .= '<h' . $block['data']['level'] . '>' . htmlspecialchars($block['data']['text']) . '</h' . $block['data']['level'] . '>';
            break;

        case 'image':
            $html .= '<img src="' . htmlspecialchars($block['data']['file']['url']) . '" alt="' . htmlspecialchars($block['data']['caption']) . '"';
            if ($block['data']['withBorder']) {
                $html .= ' style="border: 1px solid #000;"';
            }
            if ($block['data']['withBackground']) {
                $html .= ' style="background-color: #f0f0f0;"';
            }
            if ($block['data']['stretched']) {
                $html .= ' style="width: 100%;"';
            }
            $html .= ' />';
            break;

        case 'paragraph':
            $text = $block['data']['text'];
            $text = preg_replace_callback('/@@(.*?)@@/', function ($matches) {
                return '<code>' . htmlspecialchars($matches[1]) . '</code>';
            }, $text);

            $html .= '<p>' . $text . '</p>';
            break;
    }
}


echo $html;
?>
