<?php
/**
 * @created by PhpStorm loan
 * @author damon
 * @date 2020/8/6
 * @time 11:01
 * JUST do it,so what have you done today
 *
 */

namespace damon\src\ext;

use damon\src\Custom;

class File
{
    private $encryptCount = 0;

    public function __construct()
    {
        $this->encryptCount = 10;
    }

    /**
     * @param $folder
     * @param bool $ergodic
     * @return array
     */
    public function getFolderFiles($dir, $ignore = '.git')
    {
        $data = [];
        //首先先读取文件夹
        if (!is_dir($dir))
            return false;
        $handle = opendir($dir);  //opendir()函数的作用是：打开目录句柄
        //每次使用readdir后，readdir会读到下一个文件，readdir是依次读出目录中的所有文件，每次只能读一个
        if ($handle) {
            while (($fl = readdir($handle)) !== false) {
                $temp = $dir . DIRECTORY_SEPARATOR . $fl;
                //如果不加  $fl!='.' && $fl != '..'  则会造成把$dir的父级目录也读取出来
                if ($fl != $ignore && $ignore) {
                    if (is_dir($temp) && $fl != '.' && $fl != '..') {
//                    echo '目录：' . $temp . '<br>';
                        $data[$fl] = $this->getFolderFiles($temp);
                    } else {
                        if ($fl != '.' && $fl != '..') {
//                        echo '文件：' . $temp . '<br>';
                            $data[] = $fl;
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     * 复制文件
     * @param $dir
     * @param string $copyDir
     * @param string $ignore
     * @return bool
     */
    public function generateFiles($dir, $copyDir = '', $ignore = '.git')
    {
        if (!is_dir($dir))
            return false;
        $copyDir = $copyDir ? $copyDir : $dir . 'copy';
        //防止子目录也一起被复制
        $this->createDir($copyDir);
        $handle = opendir($dir);  //opendir()函数的作用是：打开目录句柄
        //每次使用readdir后，readdir会读到下一个文件，readdir是依次读出目录中的所有文件，每次只能读一个
        if ($handle) {
            while (($fl = readdir($handle)) !== false) {
                $temp = $dir . DIRECTORY_SEPARATOR . $fl;
                $copyTemp = $copyDir . DIRECTORY_SEPARATOR . $fl;
                //如果不加  $fl!='.' && $fl != '..'  则会造成把$dir的父级目录也读取出来
                if ($fl == $ignore && $ignore) {
                    continue;
                }
                if (is_dir($temp) && $fl != '.' && $fl != '..') {
                    //复制子目录
                    $this->generateFiles($temp, $copyTemp);
                } else {
                    if ($fl != '.' && $fl != '..') {
                        $fileContent = file_get_contents($temp);
                        file_put_contents($copyTemp, $fileContent);
                    }
                }
            }
        }
    }

    /**
     * 复制文件并加密
     * @param $dir
     * @param string $copyDir
     * @param string $ignore
     * @return bool
     */
    public function generateEncryptFiles($dir, $copyDir = '', $ignore = '.git')
    {
        if (!is_dir($dir))
            return false;
        if (!$copyDir) {
            $copyDir = $dir . 'copy';
        }
        $this->createDir($copyDir);
        $handle = opendir($dir);  //opendir()函数的作用是：打开目录句柄
        $custom = new Custom();
        //每次使用readdir后，readdir会读到下一个文件，readdir是依次读出目录中的所有文件，每次只能读一个
        if ($handle) {
            while (($fl = readdir($handle)) !== false) {
                $temp = $dir . DIRECTORY_SEPARATOR . $fl;
                $copyFl = $custom->setPattern(2)->setElement($fl)->encrypt($this->encryptCount)->toString();
                $copyTemp = $copyDir . DIRECTORY_SEPARATOR . $copyFl;
                //如果不加  $fl!='.' && $fl != '..'  则会造成把$dir的父级目录也读取出来
                if ($fl == $ignore && $ignore) {
                    continue;
                }
                if (is_dir($temp) && $fl != '.' && $fl != '..') {
                    //复制子目录
                    $this->generateEncryptFiles($temp, $copyTemp);
                } else {
                    if ($fl != '.' && $fl != '..') {
                        $fileContent = file_get_contents($temp);
                        $copyContent = $custom->setPattern(1)->setElement($fileContent)->encrypt($this->encryptCount)->encodeChinese()->toString();
                        file_put_contents($copyTemp, $copyContent);
                    }
                }
            }
        }
    }

    public function generateDecryptFiles($dir, $copyDir = '')
    {
        if (!is_dir($dir))
            return false;
        if (!$copyDir) {
            $copyDir = str_replace('copy', '', $dir);
            $copyDir .= 'decry';
        }
        $this->createDir($copyDir);
        $handle = opendir($dir);  //opendir()函数的作用是：打开目录句柄
        $custom = new Custom();
        //每次使用readdir后，readdir会读到下一个文件，readdir是依次读出目录中的所有文件，每次只能读一个
        if ($handle) {
            while (($fl = readdir($handle)) !== false) {
                $temp = $dir . DIRECTORY_SEPARATOR . $fl;
                $copyFl = $custom->setPattern(2)->setElement($fl)->decrypt($this->encryptCount)->toString();
                $copyTemp = $copyDir . DIRECTORY_SEPARATOR . $copyFl;
                //如果不加  $fl!='.' && $fl != '..'  则会造成把$dir的父级目录也读取出来
                if (is_dir($temp) && $fl != '.' && $fl != '..') {
                    //复制子目录
                    $this->generateDecryptFiles($temp, $copyTemp);
                } else {
                    if ($fl != '.' && $fl != '..') {
                        $fileContent = file_get_contents($temp);
                        $copyContent = $custom->setPattern(1)->setElement($fileContent)->decodeChinese()->decrypt($this->encryptCount)->toString();
                        file_put_contents($copyTemp, $copyContent);
                    }
                }
            }
        }
    }

    public function createDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}