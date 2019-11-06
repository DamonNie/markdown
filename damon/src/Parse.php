<?php
/**
 * @created by PhpStorm
 * @author damon
 * @date 2019/11/2
 * @time 12:01
 * JUST do it,so what have you done today
 *
 */

namespace damon\src;


abstract class Parse
{
    public function __call($method, $args)
    {
        if (method_exists($this, $method)) {
            $before_method = '_before_' . $method;
            if (method_exists($this, $before_method)) {
                call_user_func_array([$this, $before_method], $args);
            }
            return call_user_func_array([$this, $method], $args);
        } else {
            throw new \Exception('method:' . $method . ' not exist');
        }
    }

    protected function test()
    {
        echo 'parse';
    }

    protected function _init()
    {
    }

    /**
     * 前置处理函数
     */
    protected function _before()
    {
        echo 'before...';
    }

    /**
     * 获取一个元素值
     */

    public function getBlock()
    {

    }

    /**
     * 是否是一个元素
     */
    public function isBlock($element, $start)
    {

    }
}