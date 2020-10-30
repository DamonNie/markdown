<?php
/**
 * @created by PhpStorm loan
 * @author damon
 * @date 2020/8/6
 * @time 11:04
 * JUST do it,so what have you done today
 *
 */
require_once "./vendor/autoload.php";


use damon\src\ext\File;
use damon\src\Custom;

set_time_limit(0);
$path = 'C:\Users\W9004022\Desktop\test';
$data = (new File())->generateEncryptFiles($path);
//$path = 'C:\Users\W9004022\Desktop\permissioncopy';
//$data = (new File())->generateDecryptFiles($path);



//$test = '测试专用';
//$test1 = (new Custom())->strToAscii($test);
//$test2 = (new Custom())->asciiToStr($test1);
//print_r($test1);
//print_r($test2);
//echo PHP_EOL.PHP_EOL.PHP_EOL;
//echo PHP_EOL.PHP_EOL.PHP_EOL;
//echo PHP_EOL.PHP_EOL.PHP_EOL;
//
//$test3 = (new Custom())->unicodeEncode($input);
//$test4 = (new Custom())->unicodeDecode($test3);
//print_r($test3);
//print_r($test4);
