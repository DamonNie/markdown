<?php
/**
 * @created by PhpStorm
 * @author damon
 * @date 2019/11/2
 * @time 12:02
 * JUST do it,so what have you done today
 *
 */

namespace damon\src;


class HtmlMarkdown extends Parse
{
    private $element;

    public function setElement($element)
    {
        $this->element = $element;
        return $this;
    }

    /**
     * 前置处理函数
     */
    public function _before_parse()
    {
        $reg[] = "#[ ]*<head.*?>.*?</head>#si";//去除head
        $reg[] = "#[ ]*<script.*?>.*?</script>#si";//去除script
        $reg[] = "/[ ]*<(\!DOCTYPE*.*?)>/si";//去除<!DOCTYPE*/  /<(\!(\s\S)?)>/si
        $reg[] = "/[ ]*<(\/?html.*?)>/si"; //去除外层html
        $reg[] = "/[ ]*<(\/?input.*?)>/si"; //去除外层input
        $reg[] = "/[ ]*<(\/?body.*?)>/si"; //去除外层body
        $reg[] = "/[ ]*<(\/?meta.*?)>/si"; //去除外层meta
        $reg[] = "/[ ]*<\!--([\s\S]*)?-->/si"; //去除注释
        $this->element = preg_replace($reg, '', $this->element);
        //单引号转为双引号
        $this->element = str_replace('\'', '"', $this->element);
        $this->element = str_replace('&nbsp;', '', $this->element);
        $tidy_config = [
            'clean'          => true,
            'indent'         => true,//是否缩进
            'indent-spaces'  => 4,
            'output-xhtml'   => false,//是否是输出xhtml
            'show-body-only' => true,//是否只获得到body
            'output-html'    => true, // Output as HTML
            'wrap'           => 200,
        ];
        if (function_exists('tidy_parse_string')) {
            $tidy = @tidy_parse_string($this->element, $tidy_config, 'utf8');
            $tidy->cleanRepair();
//            $this->element = $tidy->value;
            //转义字符转化为html格式字符
            $this->element = htmlspecialchars_decode($this->element);
        } else {
            //pending
            throw new \Exception('请先开启tidy扩展');
        }
    }

    public function toString()
    {
        return trim($this->element);
    }

    protected function parse()
    {
        $pattern_array = [
            //统一处理去掉外层html元素的情况
            ["#[ ]*<figcaption[^>]*?>(.*?)</figcaption>#is", '$1', '</figcaption>'],
            ["#[ ]*<figure[^>]*?>(.*?)</figure>#is", '$1', '</figure>'],
            ["#[ ]*<div[^>]*?>(.*?)</div>#is", '$1', '</div>'],
            ["#[ ]*<article[^>]*?>(.*?)</article>#is", '$1', '</article>'],
            ["#[ ]*<span[^>]*?>(.*?)</span>#is", '$1', '</span>'],
            ["#[ ]*<u[^>]*?>(.*?)</u>#is", '$1', '</u>'],
            ["#[ ]*<font[^>]*?>(.*?)</font>#is", '$1', '</font>'],
            ["#[ ]*<svg[^>]*?>(.*?)</svg>#is", '$1', '</svg>'],
            ["#[ ]*<path[^>]*?>(.*?)</path>#is", '$1', '</path>'],
            ["#[ ]*<caption[^>]*?>(.*?)</caption>#is", '$1', '</caption>'],
            ["#[ ]*<button[^>]*?>(.*?)</button>#is", '$1', '</button>'],
            //处理p code标签
            ['#[ ]*<pre[^>]*?>(.*?)<code[^>]*?>(.*?)</code[^<]*?>(.*?)</pre>#is', "```
            $2```", '</code></pre>'],
            ['#[ ]*<code[^>]*?>(.*?)</code>#is', "`$1`", '</code>'],
            ['#[ ]*<pre[^>]*?>(.*?)</pre>#is', "`$1`", '</pre>'],
            ["#[ ]*<p[^>]*?>(.*?)</p>#is", '$1', 'p>'],
            //处理strong标签
            ["#[ ]*<strong[^>]*?>(\s*)?(.*?)</strong>#is", "**$2**", '</strong>'],
            ["#[ ]*<b[^>]*?>(\s*)?(.*?)</b>#is", "**$2**", '</b>'],
            //处理删除线标签
            ["#[ ]*<strike[^>]*?>(\s*)?(.*?)</strike>#is", "~~$2~~", '</strike>'],
            ["#[ ]*<s[^>]*?>(\s*)?(.*?)</s>#is", "~~$2~~", '</s>'],
            ["#[ ]*<del[^>]*?>(\s*)?(.*?)</del>#is", "~~$2~~", '</del>'],
            //处理竖线标签
            ["#[ ]*<blockquote[^>]*?>(\s*)?(.*?)</blockquote>#is", ">$2", '</blockquote>'],
            //处理h标签
            ["#[ ]*<h1[^>]*?>(\s*)?(.*?)(\s*)?</h1>#is", "# $2", '</h1>'],
            ["#[ ]*<h2[^>]*?>(\s*)?(.*?)</h2>#is", "## $2", '</h2>'],
            ["#[ ]*<h3[^>]*?>(\s*)?(.*?)</h3>#is", "### $2", '</h3>'],
            ["#[ ]*<h4[^>]*?>(\s*)?(.*?)</h4>#is", "#### $2", '</h4>'],
            ["#[ ]*<h5[^>]*?>(\s*)?(.*?)</h5>#is", "##### $2", '</h5>'],
            ["#[ ]*<h6[^>]*?>(\s*)?(.*?)</h6>#is", "###### $2", '</h6>'],
            //处理hr标签
            ["#[ ]*<hr[^>]*?>(.*?)</hr>#is", "---", '</hr>'],
            ["#[ ]*<hr[^>]*?>#is", "---", '<hr>'],
            //处理img标签
            ['#[ ]*<img([^>]*src="([^"]*)?")?([^>]*alt="([^"]*)?")?([^>]*title="([^"]*)?")?[^>]*?/?>#is', '![$4]($2 "$6")', '<img'],
            //处理a标签
            ['#[ ]*<a([^>]*?href="([^"]*?)")?([^>]*title="([^"]*?)")?[^>]*?>(.*?)</a>#is', '[$5]($2 "$3")', '</a>'],
            //处理斜体标签
            ["#[ ]*<i[^>]*?>(.*?)</i>#is", "*$1*", '</i>'],
            ["#[ ]*<em[^>]*?>(.*?)</em>#is", "*$1*", '</em>'],
        ];
        $this->handle_pre_ol();
        $this->handle_sample_ul();
        $this->handle_sample_ol();
        $this->handle_table();
        //需要使用pre_match_all，再进行处理html标签
        $this->handlePatternHtml($pattern_array);
        $this->element = preg_replace('#<br/?>#is', PHP_EOL, $this->element);
        return $this;
    }

    /**
     * 根据正则表达式转换element
     * @param $element
     * @param $Pattern_array
     * @return mixed
     */
    private function patternHtml($element, $Pattern_array, $i = 0)
    {
        list($reg, $html, $tag) = $Pattern_array;
        if (preg_match_all($reg, $element, $match)) {
            foreach ($match[0] as $key => $value) {
                //初始化
                $_html = $html;
                //不存在$符号，则直接替换
                if (strpos($_html, '$') !== false) {
                    foreach ($match as $kk => $vv) {
                        //根据$1、$2。。。,处理正则表达式数据
                        $_html = str_replace('$' . $kk, trim($match[$kk][$key]), $_html);
                    }
                    //如若匹配到的是空值，则null处理
                    $_flag = preg_replace('/[$\d]?/', '', $html);
                    $_html = $_html === $_flag ? '' : $_html;
                }
                $element = str_replace($match[0][$key], $_html, $element);
            }
        }
        //需要再次循环遍历
        if (strpos($element, $tag) !== false) {
            $i++;
            //阀值，最多循环10次
            if ($i == 10) {
                return $element;
            }
            $element = $this->patternHtml($element, $Pattern_array, $i);
        }
        return $element;
    }

    /**
     * 处理element数据
     * @param $pattern_array
     */
    protected function handlePatternHtml($pattern_array)
    {
        foreach ($pattern_array as $value) {
            $this->element = $this->patternHtml($this->element, $value);
        }
    }

    /**
     * 处理pre标签 代码格式
     * 1.pre标签内有ol标签（必须先处理此处，再处理ol）
     * 2.pre标签内为普通标签
     */
    protected function handle_pre_ol()
    {
        $liPattern = '#<li[^>]*?>(.*?)</li>#is';
        $preOlPattern = '#[ ]*<pre[^>]*?>[^<]*?<ol[^>]*?>(.*?)</ol>[^<]*?</pre>#is';
        $html = '```html$1```';
        if (preg_match_all($preOlPattern, $this->element, $preOls)) {
            foreach ($preOls[0] as $key => $value) {
                $_element = PHP_EOL;
                if (preg_match_all($liPattern, $preOls[1][$key], $lis)) {
                    foreach ($lis[0] as $k => $v) {
                        $_element .= strip_tags($v) . PHP_EOL;
                    }
                    $_element = str_replace('$1', $_element, $html);
                    $this->element = str_replace($value, $_element, $this->element);
                }
            }
        }
    }

    /**
     * 处理ul标签
     */
    protected function handle_sample_ul()
    {
        $liPattern = '#<li[^>]*?>(.*?)</li>#is';
        $ulPattern = '#<ul[^>]*?>(.*?)</ul>#is';
        //匹配ul标签内的li标签
        if (preg_match_all($ulPattern, $this->element, $uls)) {
            foreach ($uls[0] as $key => $value) {
                //匹配并处理li标签
                $_element = PHP_EOL;
                if (preg_match_all($liPattern, $uls[1][$key], $lis)) {
                    foreach ($lis[0] as $k => $v) {
                        $_element .= '* ' . trim($lis[1][$k]) . PHP_EOL;
                    }
                    //替换ul为null
                    $this->element = str_replace($value, $_element, $this->element);
                }
            }
        }
    }

    /**
     * 处理ol标签
     */
    protected function handle_sample_ol()
    {
        $liPattern = '#[ ]*<li[^>]*?>(.*?)</li>[ ]*#is';
        $olPattern = '#[ ]*<ol[^>]*?>(.*?)</ol>#is';
        //匹配ol标签内的li标签
        if (preg_match_all($olPattern, $this->element, $ols)) {
            foreach ($ols[0] as $key => $value) {
                //匹配并处理li标签
                if (preg_match_all($liPattern, $ols[1][$key], $lis)) {
                    foreach ($lis[0] as $k => $v) {
                        $index = $k + 1;
                        $this->element = str_replace($v, sprintf('%d.  %s', $index, trim($lis[1][$k])), $this->element);
                    }
                }
            }
        }
        //替换ol为null
        $this->element = preg_replace($olPattern, '$1', $this->element);
    }


    /**
     * 处理table表标签
     */
    protected function handle_table()
    {
        $element = $this->element;
        $tablePattern = '#<table[^>]*?>(.*?)</table>#is';
        $trPattern = '#<tr[^>]*?>(.*?)</tr>#is';
        $thPattern = '#<th[^>]*?>(.*?)</th>#is';
        $tdPattern = '#<td[^>]*?>(.*?)</td>#is';

        //匹配并压缩table字符串标签
        if (preg_match_all($tablePattern, $element, $tables)) {
            foreach ($tables[0] as $table) {
                //匹配tr标签
                $_element = PHP_EOL . '|';
                $_line = '|';
                if (preg_match_all($trPattern, $table, $trs)) {
                    foreach ($trs[0] as $key => $value) {
                        //处理th标签
                        if (preg_match_all($thPattern, $trs[1][$key], $ths)) {
                            foreach ($ths[0] as $k => $v) {
                                $_element .= trim($ths[1][$k]) . '|';
                                $_line .= '-|';
                            }
                            $_element .= PHP_EOL . $_line;
                        }
                        //处理td标签
                        if (preg_match_all($tdPattern, $trs[1][$key], $tds)) {
                            $_td = '|';
                            foreach ($tds[0] as $k => $v) {
                                $_td .= trim($tds[1][$k]) . '|';
                            }
                            $_element .= PHP_EOL . $_td;
                        }
                    }
                }
                $this->element = str_replace($table, $_element, $this->element);
            }
        }
    }

    /**
     * 处理table表标签
     */
    protected function handle_table_bak()
    {
        $tag = $this->element;
        $tablePattern = '#[ ]*<table[^>]*?>(.*?)</table>#is';
        $theadPattern = '#[ ]*<thead[^>]*?>(.*?)</thead>#is';
        $tbodyPattern = '#[ ]*<tbody[^>]*?>(.*?)</tbody>#is';
        $trPattern = '#[ ]*<tr[^>]*?>(.*?)</tr>#is';
        $thPattern = '#[ ]*<th[^>]*?>(.*?)</th>#is';
        $tdPattern = '#[ ]*<td[^>]*?>(.*?)</td>#is';

        //匹配并压缩table字符串标签
        if (preg_match_all($tablePattern, $tag, $tables)) {
            foreach ($tables[0] as $table) {
                $table_tag = str_replace(PHP_EOL, '', $table);
                $tag = str_replace($table, PHP_EOL . $table_tag, $tag);
            }
        }
        //匹配tr标签
        if (preg_match_all($trPattern, $tag, $td)) {
            foreach ($td[0] as $key => $value) {
                $tr_tag = str_replace(PHP_EOL, '', $value);
                $tag = str_replace($value, $tr_tag, $tag);
                //处理th标签
                if (preg_match_all($thPattern, $td[1][$key], $ths)) {
                    end($ths[0]);
                    $key_last = key($ths[0]);
                    $line = '|';
                    foreach ($ths[0] as $k => $v) {
                        $th_tag = $ths[1][$k] . '|';
                        $line .= '-|';
                        if ($k == 0) {
                            $th_tag = PHP_EOL . '|' . $th_tag;
                        }
                        if ($k == $key_last) {
                            $th_tag .= PHP_EOL . $line;
                        }
                        $tag = str_replace($v, $th_tag, $tag);
                    }
                }
                //处理td标签
                if (preg_match_all($tdPattern, $td[1][$key], $tds)) {
                    foreach ($tds[0] as $k => $v) {
                        $td_tag = $tds[1][$k] . '|';
                        if ($k == 0) {
                            $td_tag = PHP_EOL . '|' . $td_tag;
                        }
                        $tag = str_replace($v, $td_tag, $tag);
                    }
                }
            }
        }
        //对table thead tbody tr标签
        $tag = preg_replace($tablePattern, '$1', $tag);
        $tag = preg_replace($theadPattern, '$1', $tag);
        $tag = preg_replace($tbodyPattern, '$1', $tag);
        $tag = preg_replace($trPattern, '$1', $tag);
        $this->element = $tag;
    }
}