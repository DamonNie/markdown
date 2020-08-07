<?php
/**
* @created by PhpStorm loan
* @author damon
* @date 2020/8/3
* @time 10:31
* JUST do it,so what have you done today
*
*/

namespace damon\src;


class Custom extends Parse
{
protected $pattern = [];
protected $chinesePattern = '';

public function __construct()
        {
        //  ASCII
        //  0-9: 48-57
        //  A-Z: 65-90
//  a-z：97-122
for ($i = 33, $j = 126; $i < 127; $i++, $j--) {
$current = $i + 10;
$current = $current > 126 ? $current - (127 - 33) : $current;
        $this->pattern[chr($i)] = chr($current);
        }
        $this->chinesePattern = '/([\x{4e00}-\x{9fa5}])/u';
}

public function parse()
{
// TODO: Implement parse() method.
return $this;
}

/**
*
* @param int $count
* @return $this
*/
public function encrypt($count = 1)
{
for ($i = 0; $i < $count; $i++) {
                          $this->element = strtr($this->element, $this->pattern);
}
return $this;
}

/**
*
* @param int $count
* @return $this
*/
public function decode($count = 1)
{
$this->pattern = array_flip($this->pattern);
for ($i = 0; $i < $count; $i++) {
                          $this->element = strtr($this->element, $this->pattern);
}
return $this;
}

public function clearChinese(){
$this->element = preg_replace($this->chinesePattern,'',$this->element);
        return $this;
}

}