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
$input = "<?php
/**
 * Created by PhpStorm.
 * User: Damon
 * Date: 2017/7/3
 * Time: 11:12
 */
//增加一个入口常量，用于判断是否有权限直接进入其它文件
define('ACCESS', TRUE);
//加载初始化类
include_once 'Core/Common/functions.php';
include_once 'Core/App.class.php';
//进入到初始化类
\Core\App::run();    //由于采用命名空间，因此访问类的时候必须带上空间";
//$str = preg_match_all("/([\x{4e00}-\x{9fa5}])/u", $input, $match);
set_time_limit(0);
$path = 'C:\Users\W9004022\Desktop\oppo\test';
$data = (new File())->generateEncryptFiles($path);
$path = 'C:\Users\W9004022\Desktop\oppo\testcopy';
$data = (new File())->generateDecryptFiles($path);



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
