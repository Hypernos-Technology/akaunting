<?php

include_once base_path('vendor/iamcal/php-emoji/lib/emoji.php');

function convertEmoji($text)
{
    $emoji_directory = storage_path('app/emoji');

    if (!file_exists($emoji_directory)) {
        throw new \Exception('Emoji directory not found');
    }

    return preg_replace_callback($GLOBALS['emoji_maps']['unified_rx'], function ($m) use ($emoji_directory) {
        if (isset($m[2]) && $m[2] == "\xEF\xB8\x8E") return $m[0];
        $cp = $GLOBALS['emoji_maps']['unified_to_html'][$m[1]];

        $img = base64_encode(file_get_contents($emoji_directory . '/' . $cp . '.png'));
        return "<span lang='emoji'><img src=\"data:image/jpg;base64," . $img . "\" class=\"emoji-inner\" style='display: inline-flex; width: 1em; height: 1em;'/></span>";
    }, $text);
}

function wrapChineseTextInHTML($text)
{
    // Regular expression to match Chinese characters
    $pattern = '/[\x{4e00}-\x{9fff}]+/u'; // Unicode range for Chinese characters

    // Replace Chinese characters with wrapped HTML span
    $result = preg_replace($pattern, '<span lang="zh">$0</span>', $text);

    return $result;
}
