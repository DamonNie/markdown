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

    /**
     * Custom constructor.
     * @param int $strategy 策略模式
     * @param int $offset 偏移位
     */
    public function __construct($strategy = 1, $offset = 10)
    {
        //  ASCII码
        //  数字0-9: 48-57
        //  大写字母A-Z: 65-90
        //  小写字母a-z：97-122
        $patternRange = [];
        switch ($strategy) {
            case "1":
                for ($i = 33; $i < 127; $i++) {
                    $patternRange[] = $i;
                }
                break;
            case "2":
                for ($i = 48; $i < 58; $i++) {
                    $patternRange[] = $i;
                }
                for ($i = 65; $i < 91; $i++) {
                    $patternRange[] = $i;
                }
                for ($i = 97; $i < 123; $i++) {
                    $patternRange[] = $i;
                }
                break;
        }
        $patternCount = count($patternRange);
        foreach ($patternRange as $key => $value) {
            $currentOffset = $key + $offset;
            $currentOffset = $currentOffset >= $patternCount ? $currentOffset - $patternCount : $currentOffset;
            $this->pattern[chr($value)] = chr($patternRange[$currentOffset]);
        }
        $this->chinesePattern = '/([\x{4e00}-\x{9fa5}])/u';
    }

    public function setPattern($strategy = 1, $offset = 10)
    {
        //  ASCII码
        //  数字0-9: 48-57
        //  大写字母A-Z: 65-90
        //  小写字母a-z：97-122
        $patternRange = [];
        $this->pattern = [];
        switch ($strategy) {
            case "1":
                for ($i = 33; $i < 127; $i++) {
                    $patternRange[] = $i;
                }
                break;
            case "2":
                for ($i = 48; $i < 58; $i++) {
                    $patternRange[] = $i;
                }
                for ($i = 65; $i < 91; $i++) {
                    $patternRange[] = $i;
                }
                for ($i = 97; $i < 123; $i++) {
                    $patternRange[] = $i;
                }
                break;
        }
        $patternCount = count($patternRange);
        foreach ($patternRange as $key => $value) {
            $currentOffset = $key + $offset;
            $currentOffset = $currentOffset >= $patternCount ? $currentOffset - $patternCount : $currentOffset;
            $this->pattern[chr($value)] = chr($patternRange[$currentOffset]);
        }
        $this->chinesePattern = '/([\x{4e00}-\x{9fa5}])/u';
        return $this;
    }

    public function parse()
    {
        // TODO: Implement parse() method.
        return $this;
    }

    /**
     * 加密
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
     * 解密
     * @param int $count
     * @return $this
     */
    public function decrypt($count = 1)
    {
        $this->pattern = array_flip($this->pattern);
        for ($i = 0; $i < $count; $i++) {
            $this->element = strtr($this->element, $this->pattern);
        }
        return $this;
    }

    public function clearChinese()
    {
        $this->element = preg_replace($this->chinesePattern, '', $this->element);
        return $this;
    }

}