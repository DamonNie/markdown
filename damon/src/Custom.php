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
//        $this->chinesePattern = '/([\x{4e00}-\x{9fa5}])/u';
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

    public function encodeChinese($mode = 'ascii')
    {
        if (preg_match_all($this->chinesePattern, $this->element, $match)) {
            $pattern = [];
            foreach ($match[0] as $value) {
                switch ($mode) {
                    case 'ascii':
                        $pattern[$value] = '{{' . $this->strToAscii($value) . '}}';
                        break;
                    case 'unicode':
                        $pattern[$value] = '{{' . $this->unicodeEncode($value) . '}}';
                        break;
                    default:
                        break;
                }
            }
            $this->element = strtr($this->element, $pattern);
        }
        return $this;
    }

    public function decodeChinese($mode = 'ascii')
    {
        $tmpPattern = '/{{(.*)}}/';
        if (preg_match_all($tmpPattern, $this->element, $match)) {
            $pattern = [];
            foreach ($match[0] as $value) {
                $decodeArray = explode('}}', $value);
                $microMatch = [];
                foreach ($decodeArray as $vv) {
                    $tmpStr = strstr($vv, '{{') . '}}';
                    $decodeStr = strstr($vv, '{{');
                    $decodeStr = str_replace('{{', '', $decodeStr);
                    if (!$decodeStr) {
                        continue;
                    }
                    switch ($mode) {
                        case 'ascii':
                            $microMatch[$tmpStr] = $this->asciiToStr($decodeStr);
                            break;
                        case 'unicode':
                            $microMatch[$tmpStr] = $this->unicodeDecode($decodeStr);
                            break;
                        default:
                            break;
                    }
                }
                $pattern[$value] = strtr($value, $microMatch);
            }
            $this->element = strtr($this->element, $pattern);
        }
        return $this;
    }

    /**
     * 中文字符转化为ASCII码
     * @param $str
     * @return string
     */
    public function strToAscii($str)
    {
        $encode = mb_detect_encoding($str, ['ASCII', 'UTF-8', 'GB2312', "GBK", 'BIG5']);
        $str = mb_convert_encoding($str, 'GB2312', $encode);
        $change_after = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $temp_str = dechex(ord($str[$i]));
            $change_after .= $temp_str[1] . $temp_str[0];
        }
        return strtoupper($change_after);
    }

    /**
     * ASCII码转化为中文字符
     * @param $asc_arr
     * @return bool|false|string|string[]|null
     */
    public function asciiToStr($asc_str)
    {
        $asc_arr = str_split(strtolower($asc_str), 2);
        $str = '';
        for ($i = 0; $i < count($asc_arr); $i++) {
            $str .= chr(hexdec(@$asc_arr[$i][1] . @$asc_arr[$i][0]));
        }
        return mb_convert_encoding($str, 'UTF-8', 'GB2312');
    }

    /**
     * @param string $encoding 原始字符串的编码，默认GBK
     * @param string $prefix 编码后的前缀，默认"&#"
     * @param string $postfix 编码后的后缀，默认";"
     */
    function unicodeEncode($str, $prefix = '&#', $postfix = ';')
    {
        $encode = mb_detect_encoding($str, ['ASCII', 'UTF-8', 'GB2312', "GBK", 'BIG5']);
        $str = mb_convert_encoding($str, 'UCS-2', $encode);
        $arrstr = str_split($str, 2);
        $unistr = '';
        for ($i = 0, $len = count($arrstr); $i < $len; $i++) {
            $dec = hexdec(bin2hex($arrstr[$i]));
            $unistr .= $prefix . $dec . $postfix;
        }
        return $unistr;
    }

    /**
     * @param string $encoding 原始字符串的编码，默认GBK
     * @param string $prefix 编码字符串的前缀，默认"&#"
     * @param string $postfix 编码字符串的后缀，默认";"
     */
    function unicodeDecode($arruni, $prefix = '&#', $postfix = ';')
    {
        $arruni = explode($prefix, $arruni);
        $unistr = '';
        for ($i = 1, $len = count($arruni); $i < $len; $i++) {
            if (strlen($postfix) > 0) {
                $arruni[$i] = substr($arruni[$i], 0, strlen($arruni[$i]) - strlen($postfix));
            }
            $temp = intval($arruni[$i]);
            $unistr .= ($temp < 256) ? chr(0) . chr($temp) : chr($temp / 256) . chr($temp % 256);
        }
        return mb_convert_encoding($unistr, 'UTF-8', 'UCS-2');
    }

}