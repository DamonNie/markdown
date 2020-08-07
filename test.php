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

$path = 'C:/damon/phpwork/demo/damon';
$data = (new File())->generateEncryptFiles($path);
$path = 'C:/damon/phpwork/demo/damoncopy';
$data = (new File())->generateDecryptFiles($path);
