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


abstract class Parse implements Base
{
    protected $element;

    public function setElement($element)
    {
        $this->element = $element;
        return $this;
    }

    public function toString()
    {
        return trim($this->element);
    }

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
}