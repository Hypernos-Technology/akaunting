<?php

function wrapChineseTextInHTML($text)
{
    // Regular expression to match Chinese characters
    $pattern = '/[\x{4e00}-\x{9fff}]+/u'; // Unicode range for Chinese characters

    // Replace Chinese characters with wrapped HTML span
    $result = preg_replace($pattern, '<span lang="zh">$0</span>', $text);

    return $result;
}
