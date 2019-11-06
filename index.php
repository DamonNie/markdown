<?php

require_once "./vendor/autoload.php";


use damon\src\Convert;

$path_arr = ['a', 'blockquote', 'code', 'h', 'hr', 'i', 'md', 'ol', 'strike', 'strong', 'table', 'ul'];

foreach ($path_arr as $value) {
    $path = __DIR__ . '/data/' . $value . '.html';
    $md_path = __DIR__ . '/data/' . $value . '.md';
    Convert::getInstance()->getContent($path)->format('html_markdown')->put($md_path);
}

